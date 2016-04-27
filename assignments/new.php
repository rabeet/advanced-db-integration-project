<?php require( "../superinclude.php"); require_login(); require_professor(); ?>

<?php include ( '../views/header.html'); ?>

<body>
    <?php include ( '../views/nav.php'); ?>
    <div class="container">
        <div class="row">
            <h3>Creating new assignment</h3>
        </div>
        <div class="row">
            <?php if (current_user_isProfessor()) { // professor ?>
            <div class="col-lg-12">
                <form class="form-horizontal" role="form" action="create.php" method="POST">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Assignment's Course ID:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" name="courseid" value="<?php echo $_GET["courseid"] ?>" placeholder="Enter Course ID">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="semester_year">Assignment Name:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" name="assignmentname" placeholder="Enter Assignment Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="semester_term">Assignment Description:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="7" name="assignmenttext" placeholder="Enter Assignment or description here"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php } ?>
        </div>

</body>

</html>
