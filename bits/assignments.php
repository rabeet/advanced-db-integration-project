<?php
// Assignment CRUD operations

// // Create
function createAssignment() {
    
}
// // Read/Show
function showAssignment() {
    
}
// Index/show all assignments for user
function indexAssignments($username) {
    $pg = $GLOBALS['pg'];
    $pg_query = "SELECT assignmentid, assignmentname, assignmenttext FROM db.assignment where username = '" + $username + "';";
    $result = pg_query($pg, $pg_query);
    if(!$result) die("DB error!");
    return $result;
}
// Update
function updateAssignment() {
    
}
// Delete
function deleteAssignment() {
    
}
?>