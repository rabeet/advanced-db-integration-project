<?php
require("superinclude.php");


redirect_if_logged_in(HTTP_SCRIPT_HOME."/courses.php");
?>

<html>
<head>
	<title>LMS Login</title>
</head>
<body>
	<h1>LMS Login</h1><br>
	<?php if(isset($_SESSION["error"])) { ?>
		<h3><?php echo $_SESSION["error_message"]; ?></h3><br>
		<?php unset($_SESSION["error"]); ?>
		<?php unset($_SESSION["error_message"]); ?>
	<?php } ?>
	<form action="login.php" method="POST">
	<pre style="display:inline;">Username: </pre><input type="text" name="username" /><br>
	<pre style="display:inline;">Password: </pre><input type="password" name="password" /><br>
	<br>
	<input type="submit" />
</body>
</html>
	
