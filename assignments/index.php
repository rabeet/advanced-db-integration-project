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
				?>
				<div class="col-lg-12">
					
				</div>
			<?php } else { 
				// student
				$user_assignments = indexAssignments(current_user());
				?>
				<div class="col-lg-12">
					<div class="media">
				  <div class="media-body">
				    <table class="table table-hover table-condensed">
				      <thead>
				        <tr>
				          <th>All Assignments <strong>(<?php count($user_assignments); ?>)</strong></th>
				          <th colspan="3"></th>
				        </tr>
				      </thead>
				    
				      <tbody>
				          <tr>
				              <td>Assignment ID</td>
				              <td>Assignment name</td>
				              <td>Assignment text</td>
				              <td><a href="#">View assignment</a></td>
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
