<nav class="navbar navbar-default navbar-static-top navbar-inverse">
    <div class="container">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="/"><span class="glyphicon glyphicon-home"></span> Home</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-info-sign"></span> Courses <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <?php if(user_logged_in()) {?>
                    <li><a href="courses.php">Your courses show here!</a></li>
                    <?php } else { ?>
                    <li><a href="login.php">Please login to view your courses</a></li>
                    <?php } ?>
                </ul>
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