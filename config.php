<?php

//define("HTTP_SCRIPT_HOME", "http://core.data.wtf/project");
define("HTTP_SCRIPT_HOME", "https://adv-db-proj.herokuapp.com");

$ROLE["PROF"] = "Professor";
$ROLE["STU"] = "Student";

$POSTGRES["user"] = "rdmsrrqhbocofm";
$POSTGRES["password"] = "rbElCXko0lUGSwS1thjP9IpgKZ";
$POSTGRES["host"] = "ec2-54-163-226-48.compute-1.amazonaws.com";
$POSTGRES["dbname"] = "dfnl87c9mh4cco";
$POSTGRES["port"] = "5432";
$POSTGRES["string"] = "host=".$POSTGRES["host"]." port=".$POSTGRES["port"]." dbname=".$POSTGRES["dbname"]." user=".$POSTGRES["user"]." password=".$POSTGRES["password"];

$GLOBALS["riak"]["node1"] = "http://10.8.0.18:8098";
$GLOBALS["riak"]["node2"] = "http://10.8.0.10:8098";
?>