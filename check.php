<?php
session_start();
require_once 'functions.php';

$process = $_POST['action'];

switch ($process) {

  // INSERT
  case 'insert':
  if (validate()){
    insert();
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
