<?php
require("../superinclude.php");

require_login();
?>

<?php include ('../views/header.html'); ?>
<body>
<?php include ('../views/nav.php'); ?>
<div class="container">
	<div class="row">
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
				$all_courses = indexAllCourses();
				?>
				<div class="col-lg-12">
					<div class="media">
				  <div class="media-body">
				    <table class="table table-hover table-condensed">
				      <thead>
				        <tr>
				          <th>All Courses <strong>(<?php echo pg_num_rows($all_courses); ?>)</strong></th>
				          <th colspan="5"></th>
				        </tr>
				        <tr>
				              <td><strong>Course ID</strong></td>
				              <td><strong>Course Name</strong></td>
				              <td><strong>Section</strong></td>
				              <td><strong>Semester Term</strong></td>
				              <td><strong>Semester Year</strong></td>
				          </tr>
				      </thead>
				    
				      <tbody>
				      	<?php while ($row = pg_fetch_row($all_courses)) { ?>
								<tr>
								  <td><?php echo $row[0]; ?></td>
								  <td><?php echo $row[1]; ?></td>
								  <td><?php echo $row[2]; ?></td>
								  <td><?php echo $row[3]; ?></td>
								  <td><?php echo $row[4]; ?></td>
								  <td><a href="../assignments/new.php?courseid=<?php echo $row[0] ?>">New assignment</a></td>
								</tr>
						<?php } ?>
				      </tbody>
				    </table>
				  </div>
				</div>
				</div>
			<?php } else { 
				// student
				$user_courses = indexCourses(current_user());
				?>
				<div class="col-lg-12">
					<div class="media">
				  <div class="media-body">
				    <table class="table table-hover table-condensed">
				      <thead>
				        <tr>
				          <th>Your Course Registrations <strong>(<?php echo pg_num_rows($user_courses); ?>)</strong></th>
				          <th colspan="3"></th>
				        </tr>
				        <tr>
				              <td>Course ID</td>
				              <td>Course Name</td>
				              <td>Section</td>
				              <td>Semester Term</td>
				              <td>Semester Year</td>
				          </tr>
				      </thead>
				    
				      <tbody>
				      	<?php while ($row = pg_fetch_row($user_courses)) { ?>
								<tr>
								  <td><?php echo $row[0]; ?></td>
								  <td><?php echo $row[1]; ?></td>
								  <td><?php echo $row[2]; ?></td>
								  <td><?php echo $row[3]; ?></td>
								  <td><?php echo $row[4]; ?></td>
								  <td><a href="#">View course</a></td>
								</tr>
						<?php } ?>
				      </tbody>
				    </table>
				  </div>
				</div>
				</div>
			<?php } ?>
	</div>
</div>

</body>
</html>
