<?php
session_start();

error_reporting(0);

include("config.php");
require_once APP_ROOT . "/system/functions.php";
require_once APP_ROOT . "/system/display.php";
require_once APP_ROOT . "/classes/user.php";

define('MAXSIZE', 1024 * 1024 * 2);

date_default_timezone_set("Asia/kathmandu");

$obj = new Functions();
$user = new User();

?>
