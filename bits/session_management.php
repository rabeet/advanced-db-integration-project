<?php
@session_start();

function logout($url) {
	unset($_SESSION["logged_in"]);
	redirect($url);
	die();
}

// true if a user is logged in
function user_logged_in() {
	return (isset($_SESSION["logged_in"]));
}

// returns current username
function current_user() {
	if(user_logged_in()) {
		return (str_replace('\'', '', $_SESSION["username"]));
	} else {
		return ('Valued user');
	}
}

// returns current user's role
function current_user_role() {
	if (user_logged_in()) {
		return $_SESSION["role"];
	}
}

// returns true if user is professor
function current_user_isProfessor() {
	if (user_logged_in) {
		return (current_user_role() == "Professor");
	} else {
		// die();
	}
}

// require professor access
function require_professor() {
	if (!current_user_isProfessor()) {
		redirect(HTTP_SCRIPT_HOME);
	}
}

function login($url) {
	if(!isset($_POST["username"]) || !isset($_POST["password"])) error("Bad credentials.");
	$pg = $GLOBALS['pg'];
	
	$username = pg_escape_literal($_POST["username"]);
	$password = pg_escape_literal($_POST["password"]);
	
	
	$result = pg_query($pg, "SELECT username, role FROM db.users WHERE \"username\"=$username AND \"password\"=$password");
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
