<nav class="navbar navbar-default navbar-static-top navbar-inverse">
    <div class="container">
        <ul class="nav navbar-nav">
            <li>
                <a href="<?php echo HTTP_SCRIPT_HOME ?>"><span class="glyphicon glyphicon-home"></span> Project LMS</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-info-sign"></span> Courses <span class="caret"></span></a>
                <?php if(user_logged_in()) { ?>
                    <?php if(current_user_isProfessor()) {
                        // professor
                        $courses = indexAllCourses();
                    ?>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo HTTP_SCRIPT_HOME ?>/courses/">View All Courses</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo HTTP_SCRIPT_HOME ?>/courses/new.php">Create New Course</a></li>
                        </ul>
                    <?php } else {
                        // student
                        $courses = indexCourses(current_user());
                    ?>
                        <ul class="dropdown-menu" role="menu">
                            <?php while ($row = pg_fetch_row($courses)) { ?>
                                <li><a href="#"><?php echo $row[1]; ?></a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                <?php } ?>
            </li>
            <?php if(user_logged_in() && current_user_isProfessor()) { 
                $assignments = indexTop5Assignments();
            ?>
                <li>
                    <a href="/assignments" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-info-sign"></span> Assignments <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo HTTP_SCRIPT_HOME ?>/assignments">View All Assignments</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo HTTP_SCRIPT_HOME ?>/assignments/new.php">Create New Assignment</a></li>
                    </ul>
                </li>
                <li>
                <a href="<?php echo HTTP_SCRIPT_HOME ?>/bits/submissions"><span class="glyphicon glyphicon-info-sign"></span> Student Submissions</a>
                </li>
            <?php } ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="navbar-right">
                <?php if(user_logged_in()) {?>
                <a href="<?php echo HTTP_SCRIPT_HOME ?>/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                <?php } ?>
            </li>
        </ul>
    </div>
</nav>