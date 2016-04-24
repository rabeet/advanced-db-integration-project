<?php

// Assignment CRUD operations

// Create
function createAssignment() {{
    if (current_user_isProfessor()) {
        
    	if(!isset($_POST["courseid"]) || !isset($_POST["assignmentname"]) || !isset($_POST["assignmenttext"])) {
    	    echo 'Please check the submitted info';
    	} else {
    	    $pg = $GLOBALS['pg'];
    	
        	$assignmentname = $_POST["assignmentname"];
        	$assignmenttext = $_POST["assignmenttext"];
        	$courseid = $_POST["courseid"];
            $user = current_user();

        	$result = pg_query($pg, "INSERT INTO db.assignment (courseid, assignmentname, assignmenttext, username) VALUES ('$courseid', '$assignmentname', '$assignmenttext', '$user');");
        	if(!$result) {
        	    die("Database error!");
        	} else {
        	    redirect(HTTP_SCRIPT_HOME);
        	}
    	}
    }
}}
// Read/Show
function showAssignment($username) {
    if (!isset($_GET["assignmentid"])) {
        redirect(HTTP_SCRIPT_HOME);
    } else {
        $id = $_GET["assignmentid"];
        $pg = $GLOBALS['pg'];
        $pg_query = "SELECT db.assignment.assignmentid, db.assignment.assignmentname, db.assignment.assignmenttext, db.course.coursename FROM db.course_memberships JOIN db.course ON db.course.courseid = db.course_memberships.courseid JOIN db.assignment ON db.course_memberships.courseid = db.assignment.courseid where db.course_memberships.username = '$username' AND db.assignment.assignmentid = '$id' LIMIT(1);";
        $result = pg_query($pg, $pg_query);
        if(!$result) die("DB error!");
        return $result; 
    }
}
// Index/show all assignments for user
function indexAssignments($username) {
    $pg = $GLOBALS['pg'];
    $pg_query = "SELECT db.course_memberships.courseid, db.assignment.assignmentid, db.assignment.assignmentname, db.assignment.assignmenttext, coursename FROM db.course_memberships JOIN db.course ON db.course.courseid = db.course_memberships.courseid JOIN db.assignment ON db.course_memberships.courseid = db.assignment.courseid where db.course_memberships.username = '$username';";
    $result = pg_query($pg, $pg_query);
    if(!$result) die("DB error!");
    return $result;
}

// Index/show all assignments (professor only)
function indexAllAssignments() {
    if (current_user_isProfessor()) {
        $pg = $GLOBALS['pg'];
        $pg_query = "SELECT assignmentid, assignmentname, assignmenttext, db.assignment.courseid, coursename FROM db.assignment JOIN db.course ON db.assignment.courseid = db.course.courseid;";
        $result = pg_query($pg, $pg_query);
        if(!$result) die("DB error!");
        return $result;  
    }
}

// Index/show top 5 assignments (professor only)
function indexTop5Assignments() {
    if (current_user_isProfessor()) {
        $pg = $GLOBALS['pg'];
        $pg_query = "SELECT assignmentid, assignmentname from db.assignment LIMIT(5);";
        $result = pg_query($pg, $pg_query);
        if(!$result) die("DB error!");
        return $result;  
    }
}

// Update
function updateAssignment() {
    if (current_user_isProfessor()) {
        
    }
}
// Delete
function deleteAssignment() {
    if (current_user_isProfessor()) {
        
    }
}
?>