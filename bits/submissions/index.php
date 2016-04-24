<?php
require("../../superinclude.php");

require_login();
?>

<?php include ('../../views/header.html'); ?>
<body>
<?php include ('../../views/nav.php'); ?>
<div class="container">
    <div class="row">
        <?php //print_r($_SESSION); ?>
        <h3>Welcome <?php echo current_user_role(); ?>!</h3>
    </div>
    <div class="row">
        <?php
            // $pg = $GLOBALS['pg'];
            // $result = pg_query($pg, "SELECT courseid, coursename, section, semester_year, semester_term FROM db.course");
            // while($row = pg_fetch_row($result)) {
            //  print_r($row);
            // }
            
            if (current_user_isProfessor()) {
                // professor
                // db.submission.submissionid, db.assignment.assignmentid, db.assignment.assignmentname, db.course.coursename, db.users.username, db.submission.timestamp
                $submissions = indexAllSubmissions();
                ?>
                <div class="col-lg-12">
                    <div class="media">
                      <div class="media-body">
                        <table class="table table-hover table-condensed">
                          <thead>
                            <tr>
                              <th>All Submissions <strong>(<?php echo pg_num_rows($submissions); ?>)</strong></th>
                              <th colspan="6"></th>
                            </tr>
                            <tr>
                                <th>Submission ID</th>
                                <th>Assignment ID</th>
                                <th>Assignment Name</th>
                                <th>Course Name</th>
                                <th>Submitted By</th>
                                <th>Timestamp</th>
                                <th>File type</th>
                                <th></th>
                            </tr>
                          </thead>
                        
                          <tbody>
                            <?php while ($row = pg_fetch_row($submissions)) { ?>
                                <tr>
                                  <td><?php echo $row[0]; ?></td>
                                  <td><?php echo $row[1]; ?></td>
                                  <td><?php echo $row[2]; ?></td>
                                  <td><?php echo $row[3]; ?></td>
                                  <td><?php echo $row[4]; ?></td>
                                  <td><?php echo $row[5]; ?></td>
                                  <td><?php echo $row[6]; ?></td>
                                  <td><a href="<?php echo HTTP_SCRIPT_HOME ?>/bits/submissions/download.php?submissionid=<?php echo $row[0] . "&filetype=" . $row[6]; ?>">Download</a></td>
                                </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            <?php } else { 
                // student
                redirect(HTTP_SCRIPT_HOME);
                ?>
            <?php } ?>
    </div>
</div>

</body>
</html>
