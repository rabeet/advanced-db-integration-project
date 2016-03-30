<nav class="navbar navbar-default navbar-static-top navbar-inverse">
    <div class="container">
        <ul class="nav navbar-nav">
            <li class="active">
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
                            <?php foreach ($courses as &$course) { ?>
                                <li><a href="#">crs</a></li>
                            <?php } ?>
                        </ul>
                    <?php } else {
                        // student
                        $courses = indexCourses(current_user());
                    ?>
                        <ul class="dropdown-menu" role="menu">
                            <?php foreach ($courses as &$course) { ?>
                                <li><a href="#">crs</a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                <?php } ?>
            </li>
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