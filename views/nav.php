<nav class="navbar navbar-default navbar-static-top navbar-inverse">
    <div class="container">
        <ul class="nav navbar-nav">
            <li>
                <a href="/"><span class="glyphicon glyphicon-home"></span> Home</a>
            </li>
            <li class="dropdown">
                <a href="/courses" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-info-sign"></span> Courses <span class="caret"></span></a>
                <?php if(user_logged_in()) { ?>
                    <?php if(current_user_isProfessor()) {
                        // professor
                        $courses = indexAllCourses();
                    ?>
                        <ul class="dropdown-menu" role="menu">
                            <?php while ($row = pg_fetch_row($courses)) { ?>
                                <li><a href="#"><?php echo $row[1]; ?></a></li>
                            <?php } ?>
                            <li class="divider"></li>
                            <li><a href="/courses/new.php">Create New Course</a></li>
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
                    <a href="/assignments" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-info-sign"></span> Assignments (first 5) <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php while ($row = pg_fetch_row($assignments)) { ?>
                            <li><a href="#"><?php echo $row[1]; ?></a></li>
                        <?php } ?>
                        <li class="divider"></li>
                        <li><a href="/assignments/new.php">Create New Assignment</a></li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="navbar-right">
                <?php if(user_logged_in()) {?>
                <a href="/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                <?php } ?>
            </li>
        </ul>
    </div>
</nav>