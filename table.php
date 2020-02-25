<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">データ一覧</h2>
  </section>
  <main class="main">
    <div class="table">
      <?php
      // 変数の初期化
      $db = null;
      $row = null;
      $res = null;
      $sql = null;
      $yearSql = null;
      $monthSql = null;
      $dateSql = null;

      $db = new SQLite3("./db/database.sqlite3");

      $sql = 'SELECT * FROM reserve
              ORDER BY id desc';

      $res = $db->query($sql);
      ?>
      <table class="table__data">
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
        while($row = $res->fetchArray(2)) {

          echo "<tr>";
          for ($i=0;$i<5;$i++) {
            echo '<td>'.$row[$i].'</td>';
          }
          echo '<td>'.$row[5].':'.$row[6].'</td>';
          echo '<td>'.$row[7].':'.$row[8].'</td>';
          echo "</tr>";
        }
        ?>
      </table>
    </div>
    <div class="footer">
      <button
        type="button"
        class="button-primary"
        onclick='location.href="/"'>
        戻る
      </button>
    </div>
  </main>
</body>
</html>
