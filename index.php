<?php
require("superinclude.php");


redirect_if_logged_in(HTTP_SCRIPT_HOME."/assignments");
?>

<?php include ('views/header.html'); ?>
<body>
<?php include ('views/nav.php'); ?>

<div class="jumbotron text-center">
  <div class="container">
    <a href="/" class="lang-logo">
      <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/9658-200.png">
    </a>
    <h1>Learning Management System</h1>
    <p>Simple PHP application to serve as a Learning Management System integrating a PostgreSQL DB and Riak DS.</p>
    <p>Team LMS - Rabeet Fatmi, Rakesh Meka, Daniel Teichman</p>
    <a type="button" class="btn btn-lg btn-primary" href="https://github.com/rabeet/advanced-db-integration-project"><span class="glyphicon glyphicon-download"></span> Source on GitHub</a>
  </div>
</div>

<div class="container">
  <hr>
  <div class="row">
    <div class="col-md-12" style="text-align:center">
      <h3><span class="glyphicon glyphicon-info-sign"></span> Login</h3>
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
    </div>
  </div> <!-- row -->
   <div class="alert alert-info text-center" role="alert">
    Last edited by Rabeet Fatmi on 4/20/2016 for MS5.
  </div>
</div>
</body>
</html>
	
