<?php session_start(); ?>
<?php require_once 'functions.php'; ?>
<?php redirectTopPage(); ?>
<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">
      <?php echo $_SESSION['title']; ?>
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
          <p class="year"><?php echo $_SESSION['year']; ?></p>
          <span>年</span>
          <p class="month"><?php echo $_SESSION['month']; ?></p>
          <span>月</span>
          <p class="date"><?php echo $_SESSION['date']; ?></p>
          <span>日</span>
          <img src="images/clock.svg" class="clock">
          <p><?php echo $_SESSION['startTimeHour'] ,':',$_SESSION['startTimeMinute']; ?></p>
          <small>~</small>
          <p><?php echo $_SESSION['endTimeHour'] ,':',$_SESSION['endTimeMinute']; ?></p>
          <br>
          <img src="images/key.svg" class="key">
          <p><?php echo $_SESSION['passcode'] ?></p>
        </div>
        <p class="caption">
          <?php echo $_SESSION['message'][0]; ?>
        </p>
        <button class='button-primary' onclick='location.href="/list.php"'>予約一覧へ</button>
      </div>
    </div>
  </main>
  <?php $_SESSION = array(); ?>
</body>
</html>
