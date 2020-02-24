<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">部室予約</h2>
  </section>
  <main class="main">
    <div class="reserve">
      <form method="post" class="reserve__input" action="complete.php">
        <label for="name" class="label-name"><img src="images/music.svg">バンド名</label>
        <input class='form-name' type="text" required
        placeholder="入力してください" name="name">
        <label for="year" class="label-date"><img src="images/calendar.svg">予約日</label>
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
        <label for="startTime endTime" class="label-time"><img src="images/clock.svg">練習時間</label>
        <select class='form-starttime' name='startTime' required>
          <option value='' selected disabled>--:--</option>
          <?php
          for ($i=8;$i<=22;$i++) {
            for ($j=0;$j<=30;$j+=30) {
              $valueTime = $i*100+$j;
              $textTime = "${i}:${j}";
              if ($j==0) {
                $textTime .= 0;
              }
              if ($valueTime>2200) {
                continue;
              }
              echo "<option value='${valueTime}'>${textTime}</option>";
            }
          }
          ?>
        </select>
        <small>~</small>
        <select class='form-endtime' name='endTime' required>
          <option value='' selected disabled>--:--</option>
          <?php
          for ($i=8;$i<=22;$i++) {
            for ($j=0;$j<=30;$j+=30) {
              $valueTime = $i*100+$j;
              $textTime = "${i}:${j}";
              if ($j==0) {
                $textTime .= 0;
              }
              if ($valueTime>2200) {
                continue;
              }
              echo "<option value='${valueTime}'>${textTime}</option>";
            }
          }
          ?>
        </select>
        <br>
        <button class='button-primary' type="submit">予約</button>
      </form>
    </div>
  </main>
  <script type="text/javascript" src="js/today.js"></script>
</body>
</html>
