<?php

// validate()内でDB内の年月日を8桁にフォーマットする
function formatDate($year,$month,$date){
  if($month < 10){
    $month = '0'.$month;
  }

  if($date < 10){
    $date = '0'.$date;
  }

  $formatDate = $year.$month.$date;
  return $formatDate;
}

// insert,update時のvalidation
function validate(){

  if (!checkdate($_POST['month'], $_POST['date'], $_POST['year'])) {
    $_SESSION['message'][] = '存在する日付を入力してください。';
  }

  $dateToday = date('Ymd');
  $dateReserve = formatDate($_POST['year'],$_POST['month'],$_POST['date']);

  if ($dateReserve < $dateToday) {
    $_SESSION['message'][] = '今日以降の日付を入力してください。';
  }

  $startTime = $_POST['startTimeHour'] . $_POST['startTimeMinute'];
  $endTime   = $_POST['endTimeHour']   . $_POST['endTimeMinute'];

  if ($startTime >= $endTime) {
    $_SESSION['message'][] = '開始時間は終了時間よりも早く設定してください。';
  }

  if ($endTime - $startTime > 200) {
    $_SESSION['message'][] = '予約は2時間以下しかできません。';
  }

  $db = new SQLite3("./db/database.sqlite3");
  $sqlTable  = 'SELECT *
  FROM reserve
  WHERE year = "'.$_POST['year'].'"
  AND month = "'.$_POST['month'].'"
  AND date = "'.$_POST['date'].'"
  AND id != "'.$_POST['id'].'"';
  $resTable = $db->query($sqlTable);

  while ($rowTable = $resTable->fetchArray(1)) {

    $reserveStartTime = $rowTable['startTimeHour'] . $rowTable['startTimeMinute'];
    $reserveEndTime   = $rowTable['endTimeHour']   . $rowTable['endTimeMinute'];

    if ($reserveStartTime < $endTime && $startTime < $reserveEndTime ) {

      $_SESSION['message'][] = 'すでに予約されている時間です。<br>予約一覧を確認してください。';
    }
  }

  $isntError = !isset($_SESSION['message']);

  return $isntError;
}

// update,delete時のpasscodeチェック
function checkPass(){

  $db = new PDO("sqlite:./db/database.sqlite3");
  $stmt = $db->query('SELECT "passcode" FROM reserve WHERE id = :id');
  $stmt->execute(array(':id' => $_POST["id"]));
  $data = $stmt->fetch(PDO::FETCH_ASSOC);

  $result = ($_POST['passcode'] == $data['passcode']);

  if(!$result){
    $_SESSION['message'][] = 'パスコードが違います。';
  }

  return $result;
}

// insert処理
function insert(){

  $db = new SQLite3("./db/database.sqlite3");

  $stmt = $db->prepare(
    "INSERT INTO reserve (name, year, month, date, startTimeHour, startTimeMinute, endTimeHour, endTimeMinute, passcode)
    VALUES (?,?,?,?,?,?,?,?,?)"
  );
  $stmt->bindValue(1, $_POST['name'], SQLITE3_TEXT);
  $stmt->bindValue(2, $_POST['year'], SQLITE3_TEXT);
  $stmt->bindValue(3, $_POST['month'], SQLITE3_TEXT);
  $stmt->bindValue(4, $_POST['date'], SQLITE3_TEXT);
  $stmt->bindValue(5, $_POST['startTimeHour'], SQLITE3_TEXT);
  $stmt->bindValue(6, $_POST['startTimeMinute'], SQLITE3_TEXT);
  $stmt->bindValue(7, $_POST['endTimeHour'], SQLITE3_TEXT);
  $stmt->bindValue(8, $_POST['endTimeMinute'], SQLITE3_TEXT);
  $stmt->bindValue(9, $_POST['passcode'], SQLITE3_TEXT);
  $stmt->execute();

  $_SESSION['name'] = $_POST['name'];
  $_SESSION['year'] = $_POST['year'];
  $_SESSION['month'] = $_POST['month'];
  $_SESSION['date'] = $_POST['date'];
  $_SESSION['startTimeHour'] = $_POST['startTimeHour'];
  $_SESSION['startTimeMinute'] = $_POST['startTimeMinute'];
  $_SESSION['endTimeHour'] = $_POST['endTimeHour'];
  $_SESSION['endTimeMinute'] = $_POST['endTimeMinute'];
  $_SESSION['passcode'] = $_POST['passcode'];

  $_POST['id'] = ($db->lastInsertRowID());

  $_SESSION['title'] = '予約完了';
  $_SESSION['message'][] = '上記の日程で予約が完了しました。<br>予約の変更･削除は予約一覧からできます。';
}

// update処理
function update(){
  $db = new SQLite3("./db/database.sqlite3");

  $stmt = $db->prepare(
    'UPDATE reserve SET
    name = :name,
    year = :year,
    month = :month,
    date = :date,
    startTimeHour = :startTimeHour,
    startTimeMinute = :startTimeMinute,
    endTimeHour = :endTimeHour,
    endTimeMinute = :endTimeMinute
    WHERE id = :id'
  );

  $stmt->bindParam(':name', $_POST['name']);
  $stmt->bindParam(':year', $_POST['year']);
  $stmt->bindParam(':month', $_POST['month']);
  $stmt->bindParam(':date', $_POST['date']);
  $stmt->bindParam(':startTimeHour', $_POST['startTimeHour']);
  $stmt->bindParam(':startTimeMinute', $_POST['startTimeMinute']);
  $stmt->bindParam(':endTimeHour', $_POST['endTimeHour']);
  $stmt->bindParam(':endTimeMinute', $_POST['endTimeMinute']);
  $stmt->bindParam(':id', $_POST['id']);
  $stmt->execute();

  $_SESSION['name'] = $_POST['name'];
  $_SESSION['year'] = $_POST['year'];
  $_SESSION['month'] = $_POST['month'];
  $_SESSION['date'] = $_POST['date'];
  $_SESSION['startTimeHour'] = $_POST['startTimeHour'];
  $_SESSION['startTimeMinute'] = $_POST['startTimeMinute'];
  $_SESSION['endTimeHour'] = $_POST['endTimeHour'];
  $_SESSION['endTimeMinute'] = $_POST['endTimeMinute'];
  $_SESSION['passcode'] = $_POST['passcode'];

  $_SESSION['title'] = '変更完了';
  $_SESSION['message'][] = '上記の内容へ変更しました。<br>予約の変更･削除は予約一覧からできます。';
}

// delete処理
function delete(){
  $db = new SQLite3("./db/database.sqlite3");

  $stmt = $db->prepare(
    "DELETE FROM reserve WHERE id = :id"
  );

  $stmt->bindParam(':id', $_POST['id']);
  $stmt->execute();
}

// editページで選択したデータを取得
function getDataById(){
  $db = new PDO("sqlite:./db/database.sqlite3");
  $stmt = $db->query('SELECT * FROM reserve WHERE id = :id');
  $stmt->execute(array(':id' => $_GET["id"]));
  $selectData = $stmt->fetch(PDO::FETCH_ASSOC);
  return $selectData;
}

// DB更新でエラーが出た際のブラウザバック
function browserBackWithError($processType){
  $reservePage = "reserve.php";
  $editPage = "edit.php?id=${_POST['id']}";

  switch ($processType) {
    case 'insert':
    header("Location: $reservePage");
    exit;
    break;

    case 'update':
    case 'delete':
    header("Location: $editPage");
    exit;
    break;

    default:
    header("Location: ./index.php");
    exit;
  }
}

// DB更新時のvalidate(),checkPass()でのエラーを表示
function showError(){

  if(isset($_SESSION['message'])){
    for ($i=0; $i<count($_SESSION['message']); $i++) {
      echo '<p>'.$_SESSION['message'][$i].'</p>';
    }
    $_SESSION['message'] = null;
  }
}

// completeで$_POSTが空の場合index.phpにリダイレクトさせる
function redirectTopPage(){

  if(!isset($_SESSION['name'])){
    header('Location: ./index.php');
  };
}

// manageでパスワード違ったら淫夢4章にリダイレクトさせる
function midsummerNightsLewdDream(){
  if($_POST['password'] !== 'Yaju1145141919'){
    header('Location: https://video.fc2.com/ja/a/content/20160108UY6GqyWS');
  }
}


function send_to_slack($text, $attachment_color){
  $startTime = $_POST['startTimeHour'] .':'. $_POST['startTimeMinute'];
  $endTime   = $_POST['endTimeHour']   .':'. $_POST['endTimeMinute'];

  $webhook_url = 'https://hooks.slack.com/services/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';

  $message = [
      'text' => $text,
      'attachments' => [
          [
              'color' => $attachment_color,
              'fields' => [
                  [
                      'title' => 'バンド名: '.$_POST['name'],
                      'value' => '時間: '.$_POST['month'].'月'.$_POST['date'].'日  '.$startTime.'~'.$endTime,
                  ],
                  [
                      'value' => 'id: '.$_POST['id'].'  パスワード: '.$_POST['passcode'],
                  ]
              ]
          ]
      ]
  ]; 

  $options = array(
    'http' => array(
      'method' => 'POST',
      'header' => 'Content-Type: application/json',
      'content' => json_encode($message),
    )
  );

  $response = file_get_contents($webhook_url, false, stream_context_create($options));

  return $response === 'ok';
}

?>
