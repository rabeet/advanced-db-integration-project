<? php

// Courses CRUD operations

// Create
function createCourse() {
    if (current_user_isProfessor()) {
        $pg = $GLOBALS['pg'];
    }
}
// Read/Show
function showCourse() {
    
}
// Index/show all courses for user
function indexCourses($username) {
    $pg = $GLOBALS['pg'];
    $pg_query = "SELECT courseid FROM db.course_memberships where username = $username;";
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