<?php

$conn = mysqli_connect("localhost", "root", "", "oop");

if (!$conn) {

	exit("There was an error connection to the database!");
}