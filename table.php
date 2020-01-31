<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
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
    <h2 class="sub-header__title">データ一覧</h2>
  </section>
  <main class="main">
    <div class="main__table">
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
      $sql = 'SELECT * FROM reserve';
      $res = $db->query($sql);
      ?>
      <table class="main__table__data">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Y</th>
          <th>M</th>
          <th>D</th>
          <th>Start</th>
          <th>End</th>
        </tr>

        <?php
        while($row = $res->fetchArray()) {

          echo "<tr>";
          for ($i=0;$i<7;$i++) {
            echo '<td>'.$row[$i].'</td>';
          }
          echo "</tr>";

        }
        ?>
      </table>
    </div>
    <div class="main__footer">
      <button
        type="button"
        class="main__footer__button"
        onclick='location.href="/"'>
        戻る
      </button>
    </div>
  </main>
  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
