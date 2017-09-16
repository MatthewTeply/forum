<?php

require("classes/user.class.php");

$logout = new user;
$logout->unsetUser();

header("Location: index.php");
