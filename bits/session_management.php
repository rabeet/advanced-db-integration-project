<?php
@session_start();

function logout($url) {
	unset($_SESSION["logged_in"]);
	redirect($url);
	die();
}

function login($url) {
	if(!isset($_POST["username"]) || !isset($_POST["password"])) error("Bad credentials.");
	$pg = $GLOBALS['pg'];
	
	$username = pg_escape_literal($_POST["username"]);
	$password = pg_escape_literal($_POST["password"]);
	
	
	$result = pg_query($pg, "SELECT username, role FROM db.users WHERE \"username\"=$username AND \"password\"=MD5($password)");
	if(!$result) die("Database error!");

	$row = pg_fetch_row($result);
	if($row === false) error("Invalid credentials.");
	if($row[0] == $_POST["username"]) {
		$_SESSION["logged_in"] = true;
		$_SESSION["username"] = $username;
		$_SESSION["role"] = $row[1];
		redirect($url);
	}
	die();
}

function redirect($url) {
 	echo "<meta http-equiv='refresh' content='0; url=".$url."' />";
    die();
}

function error($msg) {
	unset($_SESION["logged_in"]);
	$_SESSION["error"] = true;
    $_SESSION["error_message"] = $msg;
    redirect(HTTP_SCRIPT_HOME);
}

function require_login() {
    //check if user is logged in and redirect to login if not logged in
        if(!isset($_SESSION["logged_in"])) {
            error("You need to log in.");
    }
}

function redirect_if_logged_in($url) {
	if(isset($_SESSION["logged_in"])) {
		redirect($url);
	}
}


?>
