<?php
require("../superinclude.php");

require_login();
require_professor();
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
				          <th>All Courses <strong>(<?php count($all_courses); ?>)</strong></th>
				          <th colspan="3"></th>
				        </tr>
				      </thead>
				    
				      <tbody>
				          <tr>
				              <td>Course ID</td>
				              <td>Course Name</td>
				              <td><a href="#">View Course Info</a></td>
				          </tr>
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
				          <th>Your Course Registrations <strong>(<?php count($user_courses); ?>)</strong></th>
				          <th colspan="3"></th>
				        </tr>
				      </thead>
				    
				      <tbody>
				          <tr>
				              <td>Course ID</td>
				              <td>Course Name</td>
				              <td><a href="#">View Course Assignments</a></td>
				          </tr>
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
