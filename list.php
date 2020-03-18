<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">予約一覧</h2>
  </section>
  <main class="main">
    <div class="list">
      <?php

      $db = new SQLite3("./db/database.sqlite3");
      $sqlCount = "SELECT COUNT(*) FROM reserve";
      $num = $db->querySingle($sqlCount);

      // 前日以前のデータを削除
      $stmt = $db->prepare('
        DELETE FROM reserve
        WHERE year = "'.date("Y").'"
        AND month < "'.date("n").'"
        OR year = "'.date("Y").'"
        AND month = "'.date("n").'"
        AND date <= "'.date("j").'"
        OR year < "'.date("Y").'"
      ');

      $stmt->execute();

      if ($num) {

        $sqlYear = 'SELECT DISTINCT year
        FROM reserve
        WHERE year >= "'.date("Y").'"
        ORDER BY year asc';

        $resYear = $db->query($sqlYear);

        while($rowYear = $resYear->fetchArray(1)) {

          foreach ($rowYear as $year) {
            $sqlMonth = 'SELECT DISTINCT month
            FROM reserve
            -- 今の年以降のデータのみ取得
            -- テスト段階では使わない
            WHERE year = "'.$year.'"
            AND year = "'.date("Y").'"
            AND month >= "'.date("n").'"
            OR year = "'.$year.'"
            AND year = "'.intval(date("Y")+1).'"
            ORDER BY month asc';

            $resMonth = $db->query($sqlMonth);

            while ($rowMonth = $resMonth->fetchArray(1)) {
              echo '<h2>';
              echo $rowYear['year'].'<span>年</span>'.$rowMonth['month'].'<span>月</span>';
              echo '</h2>';

              foreach ($rowMonth as $month) {
                $sqlDate = 'SELECT DISTINCT date
                FROM reserve
                WHERE year = "'.$year.'"
                AND month = "'.$month.'"
                ORDER BY date asc';

                $resDate = $db->query($sqlDate);

                while ($rowDate = $resDate->fetchArray(1)) {
                  echo '<h3>';
                  echo $rowDate['date'].'<span>日</span>';
                  echo '</h3>';

                  foreach ($rowDate as $date) {
                    $sqlTime = 'SELECT id, name, startTimeHour, startTimeMinute, endTimeHour, endTimeMinute
                    FROM reserve
                    WHERE year = "'.$year.'"
                    AND month = "'.$month.'"
                    AND date = "'.$date.'"
                    ORDER BY startTimeHour asc, startTimeMinute asc';

                    $resTime = $db->query($sqlTime);

                    echo '<table>';
                    while ($rowTime = $resTime->fetchArray(1)) {
                      echo '<tr>';
                      echo '<td>'.$rowTime['name'].'</td>';
                      echo '<td>'.$rowTime['startTimeHour'].':'.$rowTime['startTimeMinute'].'~'.
                      $rowTime['endTimeHour'].':'.$rowTime['endTimeMinute'].'</td>';
                      echo '<td><a href="edit.php?id='.$rowTime['id'].'">編集</a></td>';
                      echo '</tr>';
                    }
                    echo '</table>';
                  }
                }
              }
            }
          }
        }
      } else {
        echo "<div class='empty'>";
        echo "<img class='empty__logo' src='images/calendar.svg'>";
        echo "<small class='empty__caption'>最近の予約はありません</small>";
        echo "</div>";
      }
      ?>

    </div>
    <div class="footer">
      <button type="button"
      class="button-primary"
      onclick='location.href="/reserve.php"'
      >予約ページへ</button>
    </div>
  </main>
</body>
</html>
