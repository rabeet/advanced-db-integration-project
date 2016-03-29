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
      <li>
        <a href="https://devcenter.heroku.com/articles/how-heroku-works"><span class="glyphicon glyphicon-user"></span> How Heroku Works</a>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-info-sign"></span> Getting Started Guides <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="https://devcenter.heroku.com/articles/getting-started-with-ruby">Getting Started with Ruby on Heroku</a></li>
            <li><a href="https://devcenter.heroku.com/articles/getting-started-with-nodejs">Getting Started with Node on Heroku</a></li>
            <li><a href="https://devcenter.heroku.com/articles/getting-started-with-php">Getting Started with PHP on Heroku</a></li>
            <li><a href="https://devcenter.heroku.com/articles/getting-started-with-python">Getting Started with Python on Heroku</a></li>
            <li><a href="https://devcenter.heroku.com/articles/getting-started-with-java">Getting Started with Java on Heroku</a></li>
            <li><a href="https://devcenter.heroku.com/articles/getting-started-with-go">Getting Started with Go on Heroku</a></li>
            <li><a href="https://devcenter.heroku.com/articles/getting-started-with-clojure">Getting Started with Clojure on Heroku</a></li>
            <li><a href="https://devcenter.heroku.com/articles/getting-started-with-scala">Getting Started with Scala on Heroku</a></li>
            <li class="divider"></li>
            <li><a href="https://devcenter.heroku.com/articles/getting-started-with-heroku-and-connect-without-local-dev">Getting Started on Heroku with Heroku Connect</a></li>
            <li><a href="https://devcenter.heroku.com/articles/getting-started-with-jruby">Getting Started with Ruby on Heroku (Microsoft Windows)</a></li>
          </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="navbar-right">
        <a href="https://devcenter.heroku.com"><span class="glyphicon glyphicon-book"></span> Heroku Dev Center</a>
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
	
