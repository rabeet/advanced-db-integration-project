<?php
require("superinclude.php");

require_login();
?>

<?php include ('views/header.html'); ?>
<body>
<?php include ('views/nav.php'); ?>
<?php print_r($_SESSION); ?>
	<h1>Your Courses <a href="logout.php">log out</a></h1>
	<?php
		$pg = $GLOBALS['pg'];
		$result = pg_query($pg, "SELECT courseid, coursename, section, semester_year, semester_term FROM db.course");
		while($row = pg_fetch_row($result)) {
			print_r($row);
		}
	?>
</body>
</html>
