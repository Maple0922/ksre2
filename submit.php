<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">投稿完了</h2>
  </section>
  <main class="main">
    <div class="submit">
      <div class="submit__result">
        <div>
          <img src="images/person.svg">
          <p class="name"><?php echo $_POST['name']; ?></p>
          <br>
          <img src="images/calendar.svg">
          <p><?php echo $_POST['year']; ?></p>
          <span>年</span>
          <p><?php echo $_POST['month']; ?></p>
          <span>月</span>
          <p><?php echo $_POST['date']; ?></p>
          <span>日</span>
          <br>
          <img class="title-logo" src="images/pen.svg">
          <p class="title"><?php echo $_POST['title']; ?></p>
          <br>
          <img class="content-logo" src="images/clipboard.svg">
          <p class="content"><?php echo $_POST['content']; ?></p>
        </div>
        <p class="caption">
          上記の内容で投稿しました。
          <br>
          投稿の編集･削除は投稿一覧からできます。
        </p>
        <button class='button-primary' onclick='location.href="news.php"'>投稿一覧へ</button>
      </div>
    </div>
  </main>
  <?php
  $db = new SQLite3("./db/database.sqlite3");

  $stmt = $db->prepare(
    "INSERT INTO news (name, year, month, date, title, content)
    VALUES (?,?,?,?,?,?)"
  );
  $stmt->bindValue(1, $_POST['name'], SQLITE3_TEXT);
  $stmt->bindValue(2, $_POST['year'], SQLITE3_TEXT);
  $stmt->bindValue(3, $_POST['month'], SQLITE3_TEXT);
  $stmt->bindValue(4, $_POST['date'], SQLITE3_TEXT);
  $stmt->bindValue(5, $_POST['title'], SQLITE3_TEXT);
  $stmt->bindValue(6, $_POST['content'], SQLITE3_TEXT);
  $stmt->execute();
  ?>
</body>
</html>
