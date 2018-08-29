<?php

require_once('db_fns.php');

$conn=db_connect();

$result=$conn->query("select * from user where username='13132071925' and passwd= sha1('123456')");

if (isset($result)) {
    echo 1;
}
?>