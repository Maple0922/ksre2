<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">予約一覧</h2>
  </section>
  <main class="main">
    <div class="index">
      <?php
      // 変数の初期化
      $db = null;

      $sqlYear = null;
      $sqlMonth = null;
      $sqlDate = null;
      $sqlTime = null;

      $resYear = null;
      $resMonth = null;
      $resDate = null;
      $resTime = null;

      $rowYear = null;
      $rowMonth = null;
      $rowDate = null;
      $rowTime = null;


      $db = new SQLite3("./db/database.sqlite3");

      $sqlYear = 'SELECT DISTINCT year
      FROM reserve
      -- 今の年以降のデータのみ取得
      -- テスト段階では使わない
      -- WHERE year >= "'.date("Y").'"
      ORDER BY year asc';

      $resYear = $db->query($sqlYear);

      while($rowYear = $resYear->fetchArray(1)) {

        foreach ($rowYear as $year) {
          $sqlMonth = 'SELECT DISTINCT month
          FROM reserve
          -- 今の年以降のデータのみ取得
          -- テスト段階では使わない
          -- AND month >= "'.date("n").'"
          WHERE year = "'.$year.'"
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
                  $sqlTime = 'SELECT name, startTimeHour, startTimeMinute, endTimeHour, endTimeMinute
                  FROM reserve
                  WHERE year = "'.$year.'"
                  AND month = "'.$month.'"
                  AND date = "'.$date.'"
                  ORDER BY startTimeHour asc, id asc';

                  $resTime = $db->query($sqlTime);

                  echo '<table>';
                  while ($rowTime = $resTime->fetchArray(1)) {
                    echo '<tr>';
                    echo '<td>'.$rowTime['name'].'</td>';
                    echo '<td>'.$rowTime['startTimeHour'].':'.$rowTime['startTimeMinute'].'~'.
                                $rowTime['endTimeHour'].':'.$rowTime['endTimeMinute'].'</td>';
                    echo '<td><button type="text">編集</td>';
                    echo '</tr>';
                  }
                  echo '</table>';

                }
              }
            }
          }
        }
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
