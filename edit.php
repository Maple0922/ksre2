<?php include 'common/head.php' ?>
<body>
  <?php include 'common/header.php' ?>
  <section class="sub-header">
    <h2 class="sub-header__title">予約変更</h2>
  </section>
  <main class="main">
    <div class="edit">
      <?php
      $db = new PDO("sqlite:./db/database.sqlite3");
      $stmt = $db->query('SELECT * FROM reserve WHERE id = :id');
      $stmt->execute(array(':id' => $_GET["id"]));
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      ?>

      <form method="post" class="edit__input">
        <label for="name" class="label-name"><img src="images/music.svg">バンド名</label>
        <input class='form-name' type="text" required
        placeholder="入力してください" name="name"
        value="<?php echo $result['name']; ?>">
        <label for="year" class="label-date"><img src="images/calendar.svg">予約日</label>
        <select class="form-year" name="year" id="year">
          <?php
          for($i=0;$i<=1;$i++){
            $year = date('Y')+$i;
            echo "<option value='$year'";
            if ($result['year'] == $year) {
              echo "selected";
            }
            echo ">$year</option>";
          }
          ?>
        </select>
        <span>年</span>
        <select class="form-month" name="month">
          <?php
          for($i=1;$i<=12;$i++){
            echo "<option value='$i'";
            if ($result['month'] == $i) {
              echo "selected";
            }
            echo ">$i</option>";
          }
          ?>
        </select>
        <span>月</span>
        <select class="form-date" name="date">
          <?php
          for($i=1;$i<=31;$i++){
            echo "<option value='$i'";
            if ($result['date'] == $i) {
              echo "selected";
            }
            echo ">$i</option>";
          }
          ?>
        </select>
        <span>日</span>
        <label class="label-time"><img src="images/clock.svg">練習時間</label>
        <select class='form-starttime-hour' name='startTimeHour' required>
          <?php
          for ($i=8;$i<=22;$i++) {
            echo "<option value='$i'";
            if ($result['startTimeHour'] == $i) {
              echo "selected";
            }
            echo ">$i</option>";
          }
          ?>
        </select>
        <small>:</small>
        <select class='form-starttime-minute' name='startTimeMinute' required>
          <?php
          echo "<option value='00'";
          if ($result['startTimeMinute'] == '00') {
            echo "selected";
          }
          echo ">00</option>";
          echo "<option value='30'";
          if ($result['startTimeMinute'] == '30') {
            echo "selected";
          }
          echo ">30</option>";
          ?>
        </select>
        <small>  ~  </small>
        <select class='form-endtime-hour' name='endTimeHour' required>
          <?php
          for ($i=8;$i<=22;$i++) {
            echo "<option value='$i'";
            if ($result['endTimeHour'] == $i) {
              echo "selected";
            }
            echo ">$i</option>";
          }
          ?>
        </select>
        <small>:</small>
        <select class='form-endtime-minute' name='endTimeMinute' required>
          <?php
          echo "<option value='00'";
          if ($result['endTimeMinute'] == '00') {
            echo "selected";
          }
          echo ">00</option>";
          echo "<option value='30'";
          if ($result['endTimeMinute'] == '30') {
            echo "selected";
          }
          echo ">30</option>";
          ?>
        </select>
        <input type="hidden" required name="id"
        value=<?php echo $result['id']; ?>>
        <br>
        <button class='button-primary' type="submit" formaction="update.php">変更</button>
        <button class='button-danger' type="button" id="delete">削除</button>
        <button class='button-cancel' type="button" onclick='location.href="/list.php"'>一覧へ戻る</button>
        <section class="confirm">
          <div class="confirm__dialog">
            <p>本当に削除してもよろしいですか？</p>
            <div class="confirm__buttons">
              <button class="button-danger" type="submit" id="delete-button" formaction="delete.php">削除する</button>
              <button class="button-cancel" type="button" id="close-button">キャンセル</button>
            </div>
          </div>
        </section>
      </form>
    </div>
  </main>
</body>
</html>
