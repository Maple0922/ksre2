<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>くされエン部室予約アプリ</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
  <header class="header">
    <h1 class="header__title">TestApp</h1>
    <p class="header__description">くされエン部室予約アプリ</p>
  </header>
  <section class="sub-header">
    <h2 class="sub-header__title">予約一覧</h2>
  </section>
  <main class="main main-index">
    <?php
    // 変数の初期化
    $db = null;
    $sql = null;
    $res = null;
    $row = null;

    $data_id = 0;
    $data_name = 1;
    $data_year = 2;
    $data_month = 3;
    $data_date = 4;
    $data_startTime = 5;
    $data_endTime = 6;

    $db = new SQLite3("./db/reserve.sqlite3");

    // データの取得
    // $sql = 'SELECT * FROM reserve ORDER BY date asc ,startTime asc';
    $sql = 'SELECT * FROM reserve';
    $res = $db->query($sql);
    ?>

    <?php
    while( $row = $res->fetchArray() ) {
      echo "<div>";
      for ($i=4;$i<7;$i++) {
        echo '<p>' . $row[$i] . '</p>';
      }
      echo "</div>";
    }
    ?>
  </main>
  <footer class="footer">
    <button type="button" class="footer__button">予約ページへ</button>
  </footer>
  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
