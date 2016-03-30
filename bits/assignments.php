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
    $pg_query = "SELECT assignmentid, assignmentname, assignmenttext FROM db.assignment where username = $username;";
    $result = pg_query($pg, $pg_query);
    if(!$result) die("DB error!");
    return $result;
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