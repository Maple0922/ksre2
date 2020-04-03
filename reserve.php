<?php include 'common/head.php' ?>
<body>
  <script type="text/javascript" src="js/today.js"></script>
  <script type="text/javascript" src="js/toggleShow.js"></script>
  <script type="text/javascript" src="js/checkpass.js"></script>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">部室予約</h2>
  </section>
  <main class="main">
    <div class="reserve">
      <form method="post" class="reserve__input" action="validate.php">
        <label class="label-name"><img src="images/music.svg">バンド名</label>
        <input class='form-name' type="text" required
        placeholder="入力してください" name="name"
        value="" autofocus>
        <label class="label-date"><img src="images/calendar.svg">予約日</label>
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
        <label class="label-time"><img src="images/clock.svg">練習時間</label>
        <select class='form-starttime-hour' name='startTimeHour' required>
          <!-- <option value='' selected disabled>−−</option> -->
          <?php
          for ($i=8;$i<=22;$i++) {
            if($i<10){
              echo "<option value='${i}'>${i}</option>";
            }else{
              echo "<option value='${i}'>${i}</option>";
            }
          }
          ?>
        </select>
        <small>:</small>
        <select class='form-starttime-minute' name='startTimeMinute' required>
          <option value='00' selected>00</option>
          <option value='30'>30</option>
        </select>
        <small>  ~  </small>
        <select class='form-endtime-hour' name='endTimeHour' required>
          <!-- <option value='' selected disabled>−−</option> -->
          <?php
          for ($i=8;$i<=22;$i++) {
            if($i<10){
              echo "<option value='${i}'>${i}</option>";
            }else{
              echo "<option value='${i}'>${i}</option>";
            }
          }
          ?>
        </select>
        <small>:</small>
        <select class='form-endtime-minute' name='endTimeMinute' required>
          <option value='00' selected>00</option>
          <option value='30'>30</option>
        </select>
        <label class="label-password"><img src="images/key.svg">パスワード</label>
        <input class='form-password' type="password" id="number-password" required
        placeholder="****" pattern="[0-9]{4}" maxlength="4" name="password" title="半角数字4桁で入力してください。(例:1846)"
        value="">
        <span class="icons">
          <img class="show-icon" src="images/eye.svg">
          <img class="hide-icon" src="images/eye-off.svg">
        </span>
        <p>予約内容の編集･削除時に必要なパスワードです。<br>半角数字4桁で入力してください。</p>
        <button class='button-primary' type="submit">予約</button>
        <button class='button-cancel' type="button" onclick='location.href="/list.php"'>一覧へ戻る</button>
      </form>
    </div>
  </main>
</body>
</html>
