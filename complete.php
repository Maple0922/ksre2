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
        <button class='button-primary' onclick='location.href="/"'>予約一覧へ</button>
      </div>
    </div>
  </main>
</body>
</html>
