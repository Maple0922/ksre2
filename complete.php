<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <?php session_start(); ?>
  <section class="sub-header">
    <h2 class="sub-header__title">
      予約完了
    </h2>
  </section>
  <main class="main">
    <div class="complete">
      <div class="complete__result">
        <div>
          <img src="images/music.svg">
          <p class="name"><?php echo $_SESSION['name']; ?></p>
          <br>
          <img src="images/calendar.svg">
          <p><?php echo $_SESSION['year']; ?></p>
          <span>年</span>
          <p><?php echo $_SESSION['month']; ?></p>
          <span>月</span>
          <p><?php echo $_SESSION['date']; ?></p>
          <span>日</span>
          <img src="images/clock.svg" class="clock">
          <p><?php echo $_SESSION['startTimeHour'] ,':',$_SESSION['startTimeMinute']; ?></p>
          <small>~</small>
          <p><?php echo $_SESSION['endTimeHour'] ,':',$_SESSION['endTimeMinute']; ?></p>
        </div>
        <p class="caption">
          <?php echo $_SESSION['message'] ?>
        </p>
        <button class='button-primary' onclick='location.href="/list.php"'>予約一覧へ</button>
      </div>
    </div>
  </main>
  <?php $_SESSION = array(); ?>
</body>
</html>
