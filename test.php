<?php
require("superinclude.php");

$result = pg_query($pg, "SELECT username FROM db.users");
if(!$result) die("Database error!");

while($row = pg_fetch_row($result)) {
	echo $row[0]."<br>\n";
}
?>
