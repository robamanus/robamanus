<?php			
if (!isset($_SESSION)) { session_start(); }
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
ini_set("display_errors", 1);
if (function_exists('date_default_timezone_set')) {
	date_default_timezone_set('Asia/Yekaterinburg');
}
require_once $_SERVER['DOCUMENT_ROOT']."/lib/class_Template.php";
new Template();
?>