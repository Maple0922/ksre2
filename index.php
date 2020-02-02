<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <meta name="apple-mobile-web-app-title" content="部室予約">
  <title>くされエン部室予約アプリ</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel=”icon” href=“icon/favicon.png”>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
  <header class="header">
    <a class="header__link" href="/">
      <h1 class="header__title">TestApp</h1>
      <p class="header__description">くされエン部室予約アプリ</p>
    </a>
  </header>
  <section class="sub-header">
    <h2 class="sub-header__title">予約一覧</h2>
  </section>
  <main class="main">
    <div class="main__index">
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


      $db = new SQLite3("./db/reserve.sqlite3");

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
                  $sqlTime = 'SELECT name, startTime, endTime
                  FROM reserve
                  WHERE year = "'.$year.'"
                  AND month = "'.$month.'"
                  AND date = "'.$date.'"
                  ORDER BY startTime asc, id asc';

                  $resTime = $db->query($sqlTime);

                  echo '<table>';
                  while ($rowTime = $resTime->fetchArray(1)) {
                    echo '<tr>';
                    echo '<td>'.$rowTime['name'].'</td>';
                    echo '<td>'.$rowTime['startTime'].'~'.$rowTime['endTime'].'</td>';
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
    <div class="main__footer">
      <button type="button"
      class="main__footer__button"
      onclick='location.href="/reserve.php"'
      >予約ページへ</button>
    </div>
  </main>
  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
