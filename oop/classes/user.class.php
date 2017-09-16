<?php

class user {

	public function check($conn, $check_what, $check_for) {

	    $stmnt = $conn->prepare("SELECT * FROM users WHERE ".$check_what."=?");
	    $stmnt->bind_param("s", $st_check);

	    $st_check = $check_for;

	    $stmnt->execute();
	    $results = $stmnt->get_result();

	    $numRows = $results->num_rows;

	    if($numRows > 0)
	        return true;
	}

	public function setUser($conn, $username, $password, $email, $username_length, $password_length) {

		if ($this->check($conn, "uid", $username) == true)
			exit("err_uid_taken");

		elseif ($this->check($conn, "em", $email) == true)
			exit("err_em_taken");

		else {

			if (strlen($username) < $username_length)
				exit("err_uid_short");

			elseif (strlen($password) < $password_length)
				exit("err_pwd_short");

			elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username) == true)
	        	exit("err_uid_special");

	        elseif(strpos($email, "@") == false || strpos($email, ".") == false)
	        	exit("err_em_invalid");

	        else {

		        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
				$stmnt = $conn->prepare("INSERT INTO users (uid, pwd, em) VALUES (?, ?, ?)");
				$stmnt->bind_param("sss", $st_uid, $st_pwd, $st_em);

				$st_uid = $username;
				$st_pwd = $hashed_password;
				$st_em = $email;

				$stmnt->execute();

				echo("succ_uid:".$username);
				return true;
	        }
		}
	}

	public function getUser($conn, $username, $password) {

		$stmnt = $conn->prepare("SELECT * FROM users WHERE uid=?");
		$stmnt->bind_param("s", $st_uid);

		$st_uid = $username;

		$stmnt->execute();
		$results = $stmnt->get_result();

		$row = $results->fetch_assoc();

		$hash_pwd = $row['pwd'];
		$hash = password_verify($password, $hash_pwd);

		if ($hash == 0) {

			exit("Wrong name/password!");
			return false;
		}

		else {

			$stmnt = $conn->prepare("SELECT * FROM users WHERE uid=? AND pwd=?");
			$stmnt->bind_param("ss", $st_uid, $st_pwd);

			$st_uid = $username;
			$st_pwd = $hash_pwd;

			$stmnt->execute();
			$results = $stmnt->get_result();

			$numRows = $results->num_rows;
			$row = $results->fetch_assoc();

			if ($numRows == 0) {

				exit("Wrong name/password!");
				return false;
			}

			else
				return $row['uid'];
		}
	}

	public function unsetUser() {

		session_start();

		session_unset();
		session_destroy();
	}

	function showUser($conn, $uid) {

		$stmnt = $conn->prepare("SELECT * FROM users WHERE uid LIKE CONCAT('%', ?, '%')");
		$stmnt->bind_param("s", $st_uid);

		$st_uid = $uid;

		$stmnt->execute();
		$results = $stmnt->get_result();

		while ($row = $results->fetch_assoc()) {

			echo "<b>User : </b>".$row['uid']."<br>";
		}
	}
}