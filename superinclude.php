<?php
$GLOBALS['start_time'] = microtime(TRUE); //for measuring page speed
function output_load_time() {
	echo 'Page generated in '.round(microtime(TRUE)-$GLOBALS['start_time'],5).' seconds.';
}
error_reporting(E_ALL ^ E_NOTICE);
require_once("config.php");
require_once("bits/db.php");
require_once("bits/session_management.php");
require_once("bits/assignments.php");
require_once("bits/courses.php");
require_once("bits/submissions.php");
require_once("vendor/autoload.php");
?>
