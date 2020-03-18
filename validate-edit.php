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
AND date = "'.$_POST['date'].'" '
AND id != $_POST['id'];
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

  $_SESSION['message'] = '上記の内容へ変更しました。<br>予約の変更･削除は予約一覧からできます。';
  header( "Location: ./update.php");
} else {
  header( "Location: ./failed.php");
  exit;
}

?>
