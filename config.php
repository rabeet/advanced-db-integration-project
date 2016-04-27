<?php

//define("HTTP_SCRIPT_HOME", "http://core.data.wtf/project");
define("HTTP_SCRIPT_HOME", "/");

$ROLE["PROF"] = "Professor";
$ROLE["STU"] = "Student";

$POSTGRES["user"] = "jdbcavzihhfobw";
$POSTGRES["password"] = "xZSFZAUuOReDRZ8IeRM6K1vV6n";
$POSTGRES["host"] = "ec2-54-235-246-67.compute-1.amazonaws.com";
$POSTGRES["dbname"] = "dn897bdaulq6o";
$POSTGRES["port"] = "5432";
$POSTGRES["string"] = "host=".$POSTGRES["host"]." port=".$POSTGRES["port"]." dbname=".$POSTGRES["dbname"]." user=".$POSTGRES["user"]." password=".$POSTGRES["password"];

$GLOBALS["riak"]["node1"] = "http://10.8.0.18:8098";
$GLOBALS["riak"]["node2"] = "http://10.8.0.10:8098";
?>
