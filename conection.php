<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_database = 'chat';
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
if (!$con) {

    die("failed to connect!" . mysqli_error($con));
}
