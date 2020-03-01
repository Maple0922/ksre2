<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">削除完了</h2>
  </section>
  <main class="main">
    <div class="delete">
      <div class="delete__result">
        <p class="caption">
          予約を削除しました。
        </p>
        <button class='button-primary' onclick='location.href="/list.php"'>予約一覧へ</button>
      </div>
    </div>
  </main>
  <?php
  $db = new SQLite3("./db/database.sqlite3");

  $stmt = $db->prepare(
    "DELETE FROM reserve WHERE id = :id"
  );
  
  $stmt->bindParam(':id', $_POST['id']);
  $stmt->execute();
  ?>
</body>
</html>
