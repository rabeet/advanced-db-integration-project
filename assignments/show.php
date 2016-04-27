<?php
require("../superinclude.php");

require_login();
?>
<?php include ('../views/header.html'); ?>
<body>
<?php include ('../views/nav.php'); ?>
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
			// 	print_r($row);
			// }
			
			if (current_user_isProfessor()) {
				// professor
				$submissions = indexAssignmentSubmissions($_GET["assignmentid"]);
				?>
				<div class="col-lg-12">
                    <div class="media">
                      <div class="media-body">
                        <table class="table table-hover table-condensed">
                          <thead>
                            <tr>
                              <th>Submissions for Assignment <strong>(<?php echo pg_num_rows($submissions); ?>)</strong></th>
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
                                  <td><a href="<?php echo HTTP_SCRIPT_HOME ?>/bits/submissions/download.php?submissionid=<?php echo $row1[0] . "&filetype=" . $row[6]; ?>">Download</a></td>
                                </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
			<?php } else {
				// student
				$assignment = showAssignment(current_user());
				$row = pg_fetch_row($assignment);
				$submission = showSubmission(current_user(), $_GET["assignmentid"]);
				?>
				<div class="col-lg-12">
					<div class="row">
						<h1>Assignment <?php echo $row[0] . " from " . $row[3]; ?></h1>
					</div>
					<div class="row">
						<strong>Assignment name:</strong> <?php echo $row[1]; ?>
					</div>
					<div class="row">
						<strong>Assignment text:</strong> <?php echo $row[2]; ?>
					</div>
					<div class="clear"><br></div>
					<div class="row">
					<div class="col-lg-12">
						<?php if (pg_num_rows($submission) != 1) { ?>
						<form class="form-horizontal" role="form" action="<?php echo HTTP_SCRIPT_HOME; ?>/bits/submissions/create.php" method="POST" enctype="multipart/form-data">

	                		<input type="hidden" name="assignmentid" value="<?php echo $_GET["assignmentid"]; ?>">
	                		<div class="form-group">
		                        <label class="control-label col-sm-2" for="file">Select file to upload:</label>
		                        <div class="col-sm-10">
		                            <input type="file" name="file" id="file">
		                        </div>
		                    </div>

		                    <div class="form-group">
		                        <div class="col-sm-offset-2 col-sm-10">
		                            <button type="submit" class="btn btn-default">Submit Assignment</button>
		                        </div>
		                    </div>
	                	</form>
						<?php } else { ?>
							<div class="media">
							  <div class="media-body">
							    <table class="table table-hover table-condensed">
							      <thead>
							        <tr>
							          <th>Submission</th>
							          <th colspan="4"></th>
							        </tr>
							        <tr>
							        	<th>Submission ID</th>
						        		<th>Timestamp</th>
						        		<th>File Type</th>
						        		<th></th>
							        </tr>
							      </thead>
							    
							      <tbody>
									<?php while ($row1 = pg_fetch_row($submission)) { ?>
										<tr>
										  <td><?php echo $row1[0]; ?></td>
										  <td><?php echo $row1[1]; ?></td>
										  <td><?php echo $row1[2]; ?></td>
										  <td><a href="<?php echo HTTP_SCRIPT_HOME ?>/bits/submissions/download.php?submissionid=<?php echo $row1[0] . "&filetype=" . $row1[2]; ?>">Download submission</a></td>
										</tr>
									<?php } ?>
							      </tbody>
							    </table>
							  </div>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
	</div>
</div>

</body>
</html>
