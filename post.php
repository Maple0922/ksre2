<?php include 'common/head.php' ?>
<body>
  <script type="text/javascript" src="js/today.js"></script>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">業務連絡投稿</h2>
  </section>
  <main class="main">
    <div class="post">
      <form method="post" class="post__input" action="submit.php">
        <label class="label-name"><img src="images/person.svg">投稿者</label>
        <input class='form-name' type="text" required
        placeholder="入力してください" name="name"
        value="">
        <label class="label-date"><img src="images/calendar.svg">投稿日</label>
        <select class="form-year" name="year" id="year">
          <?php
          for($i=0;$i<=1;$i++){
            $year = date('Y')+$i;
            echo "<option value=$year>$year</option>";
          }
          ?>
        </select>
        <span>年</span>
        <select class="form-month" name="month">
          <?php
          for($i=1;$i<=12;$i++){
            echo "<option value=$i>$i</option>";
          }
          ?>
        </select>
        <span>月</span>
        <select class="form-date" name="date">
          <?php
          for($i=1;$i<=31;$i++){
            echo "<option value=$i>$i</option>";
          }
          ?>
        </select>
        <span>日</span>
        <label class="label-title"><img src="images/pen.svg">件名</label>
        <input type="text" class="form-title" name="title" placeholder="入力してください" value="" required>
        <label class="label-content"><img src="images/clipboard.svg">内容</label>
        <textarea name="content" placeholder="入力してください" class="form-content" required></textarea>
        <button class='button-primary' type="submit">送信</button>
        <button class='button-cancel' type="button" onclick='location.href="/news.php"'>戻る</button>
      </form>
    </div>
  </main>
</body>
</html>
