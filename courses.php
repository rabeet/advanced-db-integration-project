<?php

// Courses CRUD operations

// Create
function createCourse() {
    if (current_user_isProfessor()) {
        
    	if(!isset($_POST["coursename"]) || !isset($_POST["semester_year"]) || !isset($_POST["semester_term"])) {
    	    echo 'Please check the submitted info';
    	} else {
    	    $pg = $GLOBALS['pg'];
    	
        	$coursename = $_POST["coursename"];
        	$section = $_POST["section"];
        	$semester_year = $_POST["semester_year"];
        	$semester_term = $_POST["semester_term"];
            $user = current_user();
        	
        	$result = pg_query($pg, "INSERT INTO db.course (coursename, section, semester_year, semester_term, username) VALUES ('$coursename', '$section', $semester_year, '$semester_term', $user);");
        	if(!$result) {
        	    die("Database error!");
        	} else {
        	    redirect(HTTP_SCRIPT_HOME);
        	}
    	}
    }
}
// Read/Show
function showCourse() {
    
}
// Index/show all courses for user
function indexCourses($username) {
    $pg = $GLOBALS['pg'];
    $pg_query = "SELECT db.course_memberships.courseid, coursename FROM db.course_memberships JOIN db.course ON db.course.courseid = db.course_memberships.courseid where db.course_memberships.username = $username;";
    $result = pg_query($pg, $pg_query);
    if(!$result) die("DB error!");
    return $result;
}

// Index/show all courses (professor only)
function indexAllCourses() {
    if (current_user_isProfessor()) {
        $pg = $GLOBALS['pg'];
        $pg_query = "SELECT courseid, coursename, section FROM db.course;";
        $result = pg_query($pg, $pg_query);
        if(!$result) die("DB error!");
        return $result;  
    }
}

// Update
function updateCourse() {
    if (current_user_isProfessor()) {
        $pg = $GLOBALS['pg'];
    }
}
// Delete
function deleteCourse() {
    if (current_user_isProfessor()) {
        $pg = $GLOBALS['pg'];
    }
}
?>