<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">予約完了</h2>
  </section>
  <main class="main">
    <div class="complete">
      <div class="complete__result">
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
          上記の内容で予約が完了しました。
          <br>
          予約の変更･削除は予約一覧からできます。
        </p>
        <button class='button-primary' onclick='location.href="/list.php"'>予約一覧へ</button>
      </div>
    </div>
  </main>
  <?php
  $message = null;

  if (checkdate($_POST['month'], $_POST['date'], $_POST['year'])) {
      $message = null;
  } else {
      $message = 'The date is not exists!';
      echo $message;
  }

  $dateToday = date('Ynd');
  $dateReserve = $_POST['year'] . $_POST['month'] . $_POST['date'];

  if ($dateReserve < $dateToday) {
      $message = 'The date is too late!';
      echo $message;
  }

  $startTime = $_POST['startTimeHour'] . $_POST['startTimeMinute'];
  $endTime   = $_POST['endTimeHour']   . $_POST['endTimeMinute'];

  if ($startTime >= $endTime) {
      $message = 'endtime is fast than starttime';
      echo $message;
  }

  $db = new SQLite3("./db/database.sqlite3");
  $sqlTable  = 'SELECT *
                FROM reserve
                WHERE year = "'.$_POST['year'].'"
                AND month = "'.$_POST['month'].'"
                AND date = "'.$_POST['date'].'" ';
  $resTable = $db->query($sqlTable);

  while ($rowTable = $resTable->fetchArray(1)) {
      
      $reserveStartTime = $rowTable['startTimeHour'] . $rowTable['startTimeMinute'];
      $reserveEndTime   = $rowTable['endTimeHour']   . $rowTable['endTimeMinute'];

      if ($reserveStartTime < $endTime && $startTime < $reserveEndTime ) {

          $message = 'The time is already reserved';
          echo $message;
      }
  }

  if ($message == null) {
            $stmt = $db->prepare(
              "INSERT INTO reserve (name, year, month, date, startTimeHour, startTimeMinute, endTimeHour, endTimeMinute)
              VALUES (?,?,?,?,?,?,?,?)"
            );
            $stmt->bindValue(1, $_POST['name'], SQLITE3_TEXT);
            $stmt->bindValue(2, $_POST['year'], SQLITE3_TEXT);
            $stmt->bindValue(3, $_POST['month'], SQLITE3_TEXT);
            $stmt->bindValue(4, $_POST['date'], SQLITE3_TEXT);
            $stmt->bindValue(5, $_POST['startTimeHour'], SQLITE3_TEXT);
            $stmt->bindValue(6, $_POST['startTimeMinute'], SQLITE3_TEXT);
            $stmt->bindValue(7, $_POST['endTimeHour'], SQLITE3_TEXT);
            $stmt->bindValue(8, $_POST['endTimeMinute'], SQLITE3_TEXT);
            $stmt->execute();
        }

  ?>
</body>
</html>
