<?php require( "../superinclude.php"); require_login(); require_professor(); ?>

<?php include ( '../views/header.html'); ?>

<body>
    <?php include ( '../views/nav.php'); ?>
    <div class="container">
        <div class="row">
            <h3>Creating new course</h3>
        </div>
        <div class="row">
            <?php if (current_user_isProfessor()) { // professor ?>
            <div class="col-lg-12">
                <form class="form-horizontal" role="form" action="create.php" method="POST">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Course Name:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" name="coursename" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="section">Course Section:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" name="section" placeholder="Enter section">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="semester_year">Semester Year:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" name="semester_year" placeholder="Enter Semester Year">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="semester_term">Semester Term:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" name="semester_term" placeholder="Enter Semester Term">
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
