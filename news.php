<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">業務連絡</h2>
  </section>
  <main class="main">
    <div class="news">
      <?php

      $db = new SQLite3("./db/database.sqlite3");
      $sqlCount = "SELECT COUNT(*) FROM news";
      $num = $db->querySingle($sqlCount);

      if ($num) {

        $sqlNews = 'SELECT *
        FROM news
        WHERE year >= "'.intval(date("Y")-1).'"
        ORDER BY id desc';

        $resNews = $db->query($sqlNews);

        while($rowNews = $resNews->fetchArray(SQLITE3_ASSOC)) {
          echo '<div class="news__item">';
          echo '<h2><img src="images/pen.svg">'.$rowNews['title'].'</h2>';
          echo '<p class="content">'.$rowNews['content'].'</p>';
          echo '<h3><img src="images/person.svg"><span>'.$rowNews['name'].'</span></h4>';
          echo '<h4><img src="images/calendar.svg">'.$rowNews['year'].'/'.$rowNews['month'].'/'.$rowNews['date'].'</h3>';
          echo '</div>';
        }
      } else {
        echo "<div class='empty'>";
        echo "<img class='empty__logo' src='images/clipboard.svg'>";
        echo "<small class='empty__caption'>業務連絡はありません</small>";
        echo "</div>";
      }
      ?>
    </div>
    <div class="footer">
      <button type="button"
      class="button-primary"
      onclick='location.href="/post.php"'
      >新規投稿</button>
    </div>
  </main>
</body>
</html>
