<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">ホーム</h2>
  </section>
  <main class="main">
    <div class="index">
      <ul>
        <li><a href="/list.php"><img src="images/calendarW.svg">予約一覧</a></li>
        <li><a href="/reserve.php"><img src="images/musicW.svg">部室予約</a></li>
        <li><a href="/news.php"><img src="images/clipboardW.svg">業務連絡</a></li>
        <li><a href="/post.php"><img src="images/penW.svg">業務連絡投稿</a></li>
        <li><a id="manage"><img src="images/keyW.svg">管理者用</a></li>
      </ul>
      <form action="manage.php" method="post">
        <section class="confirm">
          <div class="confirm__dialog">
            <p>パスワードを入れてください</p>
            <input class='form-password' type="password" required name="password" value="">
            <div class="confirm__buttons">
              <button class="button-primary" type="submit" id="login-button" action="manage.php">ログイン</button>
              <button class="button-cancel" type="button" id="close-button">キャンセル</button>
            </div>
          </div>
        </section>
      </form>
    </div>
  </main>
</body>
</html>
