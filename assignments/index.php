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
				$user_assignments = indexAllAssignments();
				?>
				<div class="col-lg-12">
					<div class="media">
					  <div class="media-body">
					    <table class="table table-hover table-condensed">
					      <thead>
					        <tr>
					          <th>All Assignments <strong>(<?php pg_num_rows($user_assignments); ?>)</strong></th>
					          <th colspan="3"></th>
					        </tr>
					      </thead>
					    
					      <tbody>
							<?php while ($row = pg_fetch_row($user_assignments)) { ?>
								<tr>
								  <td><?php echo $row[0]; ?></td>
								  <td><?php echo $row[1]; ?></td>
								  <td><?php echo $row[2]; ?></td>
								  <td><?php echo $row[3]; ?></td>
								  <td><a href="#">View assignment</a></td>
								</tr>
							<?php } ?>
					      </tbody>
					    </table>
					  </div>
					</div>
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
				          <th>All Assignments <strong>(<?php pg_num_rows($user_assignments); ?>)</strong></th>
				          <th colspan="3"></th>
				        </tr>
				      </thead>
				    
				      <tbody>
						<?php while ($row = pg_fetch_row($user_assignments)) { ?>
							<tr>
							  <td><?php echo $row[0]; ?></td>
							  <td><?php echo $row[1]; ?></td>
							  <td><?php echo $row[2]; ?></td>
							  <td><?php echo $row[3]; ?></td>
							  <td><a href="#">View assignment</a></td>
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
