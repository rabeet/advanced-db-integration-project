<?php
require("../superinclude.php");

require_professor();
if(!isset($_POST["coursename"]) || !isset($_POST["semester_year"]) || !isset($_POST["semester_term"])) {
    error("Please check the submitted info.");
} else {
    // createCourse();
}
?>