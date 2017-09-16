<?php

require("classes/user.class.php");
include 'db.inc.php';

function showUsr($conn, $username) {

	$user_query = new user;
	echo $user_query->showUser($conn, $username);
}

//=For Ajax=
if (isset($_POST['showUsr_call'])) {

	showUsr($conn, $_POST['uid']);
}