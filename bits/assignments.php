<?php

// Assignment CRUD operations

// Create
function createAssignment($assignmentname, $assignmenttext) {
    if (current_user_isProfessor()) {
        $pg = $GLOBALS['pg'];
    }
}
// Read/Show
function showAssignment($assignmentid) {
    
}
// Index/show all assignments for user
function indexAssignments($username) {
    $pg = $GLOBALS['pg'];
    $pg_query = "SELECT db.course_memberships.courseid, db.assignment.assignmentid, db.assignment.assignmentname, db.assignment.assignmenttext, coursename FROM db.course_memberships JOIN db.course ON db.course.courseid = db.course_memberships.courseid JOIN db.assignment ON db.course_memberships.courseid = db.assignment.courseid where db.course_memberships.username = $username;";
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