<?php

//define("HTTP_SCRIPT_HOME", "http://core.data.wtf/project");
define("HTTP_SCRIPT_HOME", "/project");

$ROLE["PROF"] = "Professor";
$ROLE["STU"] = "Student";

$POSTGRES["user"] = "postgres";
$POSTGRES["password"] = "postgres";
$POSTGRES["host"] = "192.168.56.101";
$POSTGRES["dbname"] = "postgres";
$POSTGRES["port"] = "5432";
$POSTGRES["string"] = "host=".$POSTGRES["host"]." port=".$POSTGRES["port"]." dbname=".$POSTGRES["dbname"]." user=".$POSTGRES["user"]." password=".$POSTGRES["password"];

$RIAK["username"] = "riak";
$RIAK["password"] = "riak";
?>
