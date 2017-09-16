<?php

require("classes/user.class.php");
include 'db.inc.php';

$uid = $_POST['uid'];
$pwd = $_POST['pwd'];
$em = $_POST['em'];

$signup = new user;
$signup->setUser($conn, $uid, $pwd, $em, 5, 6);