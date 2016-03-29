<?php
require("superinclude.php");

require_login();
?>

<html>
<head>
	<title>Course Overview</title>
</head>
<body>
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
