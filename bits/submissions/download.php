<?php
require("../../superinclude.php");
$type = $_GET["filetype"];
header("Content-Disposition: attachment; filename=\"assignment.$type\"");
downloadSubmission($_GET["submissionid"]);
?>