<?php

// Submissions CRUD operations

// Create
function createSubmission() {
    if (!current_user_isProfessor()) {
        // File upload starts
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $uploadOk = 1;

        if ($_FILES["file"]["size"] > 1200000) {
            echo "Sorry, your file is too large. Max is 1MB.";
            $uploadOk = 0;
        }

        // Allow word and pdf files only
        if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf") {
            echo "Sorry, only doc, docx and pdf files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            $type = $_FILES["file"]["type"];
            storeRiak('test'/* submission id should go here */, file_get_contents($_FILES['file']['tmp_name']));
            die("success");
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file..";
                die();
            }
        } else {
            echo "Sorry, there was an error uploading your file...";
            die();
        }
        // File upload ends

        // SQL stuff starts here

        // SQL stuff ends here
    }
}
// Read/Show
function showSubmission() {
    
}
// Index/show all submissions for user
function indexSubmmissions($username) {
    $pg = $GLOBALS['pg'];
    $pg_query = "SELECT db.course_memberships.courseid, coursename, section, semester_term, semester_year FROM db.course_memberships JOIN db.course ON db.course.courseid = db.course_memberships.courseid where db.course_memberships.username = '$username';";
    $result = pg_query($pg, $pg_query);
    if(!$result) die("DB error!");
    return $result;
}

// Index/show all submissions (professor only)
function indexAllSubmissions() {

}

// Update probably not used

// Delete
function deleteSubmission() {

}
?>