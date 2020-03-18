<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <?php session_start(); ?>
  <section class="sub-header">
    <h2 class="sub-header__title">
      エラー
    </h2>
  </section>
  <main class="main">
    <div class="failed">
      <div class="failed__result">
        <p class="caption">
          <?php echo $_SESSION['message'] ?>
        </p>
        <button class='button-cancel' onclick='location.href="/list.php"'>予約一覧へ</button>
      </div>
    </div>
  </main>
  <?php $_SESSION = array(); ?>
</body>
</html>
