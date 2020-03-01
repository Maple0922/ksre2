<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">変更完了</h2>
  </section>
  <main class="main">
    <div class="update">
      <div class="update__result">
        <div>
          <img src="images/music.svg">
          <p class="name"><?php echo $_POST['name']; ?></p>
          <br>
          <img src="images/calendar.svg">
          <p><?php echo $_POST['year']; ?></p>
          <span>年</span>
          <p><?php echo $_POST['month']; ?></p>
          <span>月</span>
          <p><?php echo $_POST['date']; ?></p>
          <span>日</span>
          <img src="images/clock.svg" class="clock">
          <p><?php echo $_POST['startTimeHour'] ,':',$_POST['startTimeMinute']; ?></p>
          <small>~</small>
          <p><?php echo $_POST['endTimeHour'] ,':',$_POST['endTimeMinute']; ?></p>
        </div>
        <p class="caption">
          上記の内容へ変更しました。
          <br>
          予約の変更･削除は予約一覧からできます。
        </p>
        <button class='button-primary' onclick='location.href="/list.php"'>予約一覧へ</button>
      </div>
    </div>
  </main>
  <?php
  $db = new SQLite3("./db/database.sqlite3");

  $stmt = $db->prepare(
    'UPDATE reserve SET
      name = :name,
      year = :year,
      month = :month,
      date = :date,
      startTimeHour = :startTimeHour,
      startTimeMinute = :startTimeMinute,
      endTimeHour = :endTimeHour,
      endTimeMinute = :endTimeMinute
     WHERE id = :id'
  );

  $stmt->bindParam(':name', $_POST['name']);
  $stmt->bindParam(':year', $_POST['year']);
  $stmt->bindParam(':month', $_POST['month']);
  $stmt->bindParam(':date', $_POST['date']);
  $stmt->bindParam(':startTimeHour', $_POST['startTimeHour']);
  $stmt->bindParam(':startTimeMinute', $_POST['startTimeMinute']);
  $stmt->bindParam(':endTimeHour', $_POST['endTimeHour']);
  $stmt->bindParam(':endTimeMinute', $_POST['endTimeMinute']);
  $stmt->bindParam(':id', $_POST['id']);
  $stmt->execute();

  ?>
</body>
</html>
