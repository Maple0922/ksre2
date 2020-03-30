<?php
session_start();

if (!checkdate($_POST['month'], $_POST['date'], $_POST['year'])) {
  $_SESSION['message'] = '存在する日付を入力してください。';
}

$dateToday = date('Ynd');
$dateReserve = $_POST['year'] . $_POST['month'] . $_POST['date'];

if ($dateReserve < $dateToday) {
  $_SESSION['message'] = '今日以降の日付を入力してください。';
}

$startTime = $_POST['startTimeHour'] . $_POST['startTimeMinute'];
$endTime   = $_POST['endTimeHour']   . $_POST['endTimeMinute'];

if ($startTime >= $endTime) {
  $_SESSION['message'] = '開始時間は終了時間よりも早く設定してください。';
}

if ($endTime - $startTime > 200) {
  $_SESSION['message'] = '予約は2時間以下しかできません。';
}

$db = new SQLite3("./db/database.sqlite3");
$sqlTable  = 'SELECT *
FROM reserve
WHERE year = "'.$_POST['year'].'"
AND month = "'.$_POST['month'].'"
AND date = "'.$_POST['date'].'" ';
$resTable = $db->query($sqlTable);

while ($rowTable = $resTable->fetchArray(1)) {

  $reserveStartTime = $rowTable['startTimeHour'] . $rowTable['startTimeMinute'];
  $reserveEndTime   = $rowTable['endTimeHour']   . $rowTable['endTimeMinute'];

  if ($reserveStartTime < $endTime && $startTime < $reserveEndTime ) {

    $_SESSION['message'] = 'すでに予約されている時間には予約できません。<br>別の時間で予約してください。';
  }
}

if ($_SESSION['message'] == null) {
  $stmt = $db->prepare(
    "INSERT INTO reserve (name, year, month, date, startTimeHour, startTimeMinute, endTimeHour, endTimeMinute)
    VALUES (?,?,?,?,?,?,?,?)"
  );
  $stmt->bindValue(1, $_POST['name'], SQLITE3_TEXT);
  $stmt->bindValue(2, $_POST['year'], SQLITE3_TEXT);
  $stmt->bindValue(3, $_POST['month'], SQLITE3_TEXT);
  $stmt->bindValue(4, $_POST['date'], SQLITE3_TEXT);
  $stmt->bindValue(5, $_POST['startTimeHour'], SQLITE3_TEXT);
  $stmt->bindValue(6, $_POST['startTimeMinute'], SQLITE3_TEXT);
  $stmt->bindValue(7, $_POST['endTimeHour'], SQLITE3_TEXT);
  $stmt->bindValue(8, $_POST['endTimeMinute'], SQLITE3_TEXT);
  $stmt->execute();

  $_SESSION['name'] = $_POST['name'];
  $_SESSION['year'] = $_POST['year'];
  $_SESSION['month'] = $_POST['month'];
  $_SESSION['date'] = $_POST['date'];
  $_SESSION['startTimeHour'] = $_POST['startTimeHour'];
  $_SESSION['startTimeMinute'] = $_POST['startTimeMinute'];
  $_SESSION['endTimeHour'] = $_POST['endTimeHour'];
  $_SESSION['endTimeMinute'] = $_POST['endTimeMinute'];

  $_SESSION['message'] = '上記の日程で予約が完了しました。<br>予約の変更･削除は予約一覧からできます。';
  header( "Location: ./complete.php");
} else {
  header( "Location: ./failed.php");
  exit;
}

?>
