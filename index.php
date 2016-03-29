<?php
require("superinclude.php");


redirect_if_logged_in(HTTP_SCRIPT_HOME."/courses.php");
?>

<html>
<head>
	<title>LMS Login</title>
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/stylesheets/main.css" />
</head>
<body>
	
	<nav class="navbar navbar-default navbar-static-top navbar-inverse">
  <div class="container">
    <ul class="nav navbar-nav">
      <li class="active">
        <a href="/"><span class="glyphicon glyphicon-home"></span> Home</a>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-info-sign"></span> Courses <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="courses.php">Courses</a></li>
            <li class="divider"></li>
          </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="navbar-right">
        <a href="login.php"><span class="glyphicon glyphicon-book"></span> Account</a>
      </li>
    </ul>
  </div>
</nav>

	<h1>LMS Login</h1><br>
	<?php if(isset($_SESSION["error"])) { ?>
		<h3><?php echo $_SESSION["error_message"]; ?></h3><br>
		<?php unset($_SESSION["error"]); ?>
		<?php unset($_SESSION["error_message"]); ?>
	<?php } ?>
	<form action="login.php" method="POST">
	<pre style="display:inline;">Username: </pre><input type="text" name="username" /><br>
	<pre style="display:inline;">Password: </pre><input type="password" name="password" /><br>
	<br>
	<input type="submit" />
</body>
</html>
	
