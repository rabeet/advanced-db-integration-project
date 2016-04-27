<?php

// Submissions CRUD operations

// Create
function createSubmission() {
    if (user_logged_in()) {

        /* 
            $coursename = $_POST["coursename"];
            $section = $_POST["section"];
            $semester_year = $_POST["semester_year"];
            $semester_term = $_POST["semester_term"];
            $user = current_user();
            
            $result = pg_query($pg, "INSERT INTO db.course (coursename, section, semester_year, semester_term, username) VALUES ('$coursename', '$section', $semester_year, '$semester_term', '$user');");
        */

        // File upload starts
        $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $uploadOk = 1;

        if ($_FILES["file"]["size"] > 1200000) {
            echo "Sorry, your file is too large. Max is 1MB. ";
            $uploadOk = 0;
        }

        // Allow word and pdf files only
        if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf") {
            echo "Sorry, only doc, docx and pdf files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {

            // SQL stuff starts here
            $pg = $GLOBALS['pg'];
            $user = current_user();
            $assignmentid = $_POST["assignmentid"];
            $result = pg_query($pg, "INSERT INTO db.submission (username, assignmentid, filetype, done) VALUES ('$user', '$assignmentid', '$imageFileType', 'false') RETURNING submissionid;");
            if(!$result) {
                die("Database error!");
            } else {
                // nutthing
            }
			
			//get submissionid
			$row = pg_fetch_row($result);
			$newid = $row[0];
			
			//store file in riak
            $type = $_FILES["file"]["type"];
            storeRiak($newid, file_get_contents($_FILES['file']['tmp_name']));
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
                // now update the row to done = true
                redirect(HTTP_SCRIPT_HOME);
            } else {
                echo "Sorry, there was an error uploading your file..";
                die();
            }
			
			//flag submissionid as done
			$result = pg_query($pg, "UPDATE db.submission SET done = 'true' WHERE submissionid = '$newid';");
			if(!$result) {
				die("There was a problem with your submission.  Database error.");
			} else {
				//nothing
			}
			
			// SQL stuff ends here
        } else {
            echo "Sorry, there was an error uploading your file...";
            die();
        }
        // File upload ends

        
    }
}
// Read/Show
function showSubmission($username, $assignmentid) {
    if (user_logged_in()) {
        $pg = $GLOBALS['pg'];
        $pg_query = "SELECT db.submission.submissionid, db.submission.timestamp, db.submission.filetype FROM db.submission where db.submission.username = '$username' AND db.submission.assignmentid = '$assignmentid' LIMIT(1);";
        $result = pg_query($pg, $pg_query);
        if(!$result) die("DB error!");
        return $result; 
    }
}

function validateSubmission($key) {
   $pg = $GLOBALS['pg'];
   $user = current_user();
   $pg_query = "SELECT db.submission.submissionid FROM db.submission where db.submission.username = '$user' AND db.submission.submissionid = '$key' LIMIT(1);";
   $result = pg_query($pg, $pg_query);
   if(!$result) {
	   echo $result;
	   die();
   }
   if (pg_num_rows($result) == 1) {
       // OK
       return true;
   } else {
       // Not OK
       return false;
   }
}

// Download submission
function downloadSubmission($key) {
   if (!current_user_isProfessor() ) {
       // if student then validate
       if (validateSubmission($key)) {
           fetchRiak($key);
       } else {
           redirect(HTTP_SCRIPT_HOME);
       }
   } else {
       // otherwise allow professor
       fetchRiak($key);
   }
}
// Index/show all submissions for user
// function indexSubmmissions($username) {
//     $pg = $GLOBALS['pg'];
//     $pg_query = "SELECT db.course_memberships.courseid, coursename, section, semester_term, semester_year FROM db.course_memberships JOIN db.course ON db.course.courseid = db.course_memberships.courseid where db.course_memberships.username = '$username';";
//     $result = pg_query($pg, $pg_query);
//     if(!$result) die("DB error!");
//     return $result;
// }

// Index/show all submissions (professor only)
function indexAllSubmissions() {
    $pg = $GLOBALS['pg'];
    $pg_query = "SELECT db.submission.submissionid, db.assignment.assignmentid, db.assignment.assignmentname, db.course.coursename, db.users.username, db.submission.timestamp, db.submission.filetype FROM db.submission JOIN db.assignment ON db.submission.assignmentid = db.assignment.assignmentid JOIN db.course ON db.assignment.courseid = db.course.courseid JOIN db.users ON db.users.username = db.submission.username";
    $result = pg_query($pg, $pg_query);
    if(!$result) die("DB error!");
    return $result;
}

function indexAssignmentSubmissions($assignmentid) {
   $pg = $GLOBALS['pg'];
   $pg_query = "SELECT db.submission.submissionid, db.assignment.assignmentid, db.assignment.assignmentname, db.course.coursename, db.users.username, db.submission.timestamp, db.submission.filetype FROM db.submission JOIN db.assignment ON db.submission.assignmentid = db.assignment.assignmentid JOIN db.course ON db.assignment.courseid = db.course.courseid JOIN db.users ON db.users.username = db.submission.username where db.submission.assignmentid = '$assignmentid'";
   $result = pg_query($pg, $pg_query);
   if(!$result) die("DB error!");
   return $result;
}

// Update probably not used

// Delete
function deleteSubmission() {

}
?>