<?php
session_start();
require_once 'functions.php';

$process = $_POST['action'];

switch ($process) {

  // INSERT
  case 'insert':
  if (validate()){
    insert();
    send_to_slack('予約されました。', 'good');
    header("Location: ./complete.php");
    exit;
    break;
  }
  browserBackWithError($process);
  exit;

  // UPDATE
  case 'update':
  if (checkPass()){
    if (validate()){
      update();
      send_to_slack('更新されました。', 'warning');
      header("Location: ./complete.php");
      exit;
      break;
    }
    browserBackWithError($process);
    exit;
  }
  browserBackWithError($process);
  exit;

  // DELETE
  case 'delete':
  if (checkPass()){
    delete();
    send_to_slack('削除されました。', 'danger');
    header("Location: ./delete.php");
    exit;
    break;
  }
  browserBackWithError($process);
  exit;

  // DEFAULT
  default:
  header("Location: ./index.php");
  exit;
}


// browserBackWithError($process);
// exit;

?>
