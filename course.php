<?php
require("superinclude.php");

require_login();
if(!isset($_GET["courseid"])) error("Missing course id");

print_r($_GET);
$pg = $GLOBALS['pg'];
$eCID = pg_escape_literal($_GET["courseid"]);
$result = pg_query($pg, "SELECT coursename FROM db.course WHERE courseid=$eCID");
if(!$result) die("Database error");
$row = pg_fetch_row($result);
if($row === false) error("Bad course ID");
$courseName = $row[0];
?>

<html>
<head>
	<title>LMS <?php echo $courseName; ?></title>
</head>
<body>
<?php print_r($_SESSION); ?>
	
	<h1><?php echo $courseName; ?> <a href="logout.php">log out</a></h1>
	<?php
		
		$result = pg_query($pg, "SELECT assignmentname, assignmenttext, assignmentid, visible FROM db.assignment WHERE courseid=$eCID");
		while($row = pg_fetch_row($result)) {
			print_r($row);
		}
	?>
</body>
</html>
