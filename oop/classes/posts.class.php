<?php

class posts {

	function setPost($conn, $content, $username) {

		$stmnt = $conn->prepare("INSERT INTO posts (content, op) VALUES (?, ?)");
		$stmnt->bind_param("ss", $st_content, $st_op);

		$st_content = $content;
		$st_op = $username;

		$stmnt->execute();

		echo $content;
	}

	function getPost($conn, $username) {

		$stmnt = $conn->prepare("SELECT * FROM posts WHERE op=? AND mid IS NULL");
		$stmnt->bind_param("s", $st_op);

		$st_op = $username;

		$stmnt->execute();
		$results = $stmnt->get_result();

		while ($row = $results->fetch_assoc())
			echo "<a href=index.php?art=".$row['id']."><b>Post : </b>".$row['content']."</a><br><br>";
	}

	function showPost($conn) {

		$stmnt = $conn->prepare("SELECT * FROM posts WHERE mid IS NULL");
		$stmnt->execute();
		$results = $stmnt->get_result();

		while ($row = $results->fetch_assoc())
			echo "<a href='index.php?art=".$row['id']."'>Post : ".$row['content']."<br>By : ".$row['op']."</a><br><br>";
	}

	function showArticle($conn, $id) {

		$stmnt = $conn->prepare("SELECT * FROM posts WHERE id=? AND mid IS NULL");
		$stmnt->bind_param("s", $st_id);

		$st_id = $id;

		$stmnt->execute();
		$results = $stmnt->get_result();

		$row = $results->fetch_assoc();

		echo "<b>Article : </b>".$row['content']."<br>By : ".$row['op']."<br><br>";			
	}

	function setComment_Article($conn, $content, $op, $mid) {

		$stmnt = $conn->prepare("INSERT INTO posts (content, op, mid) VALUES (?, ?, ?)");
		$stmnt->bind_param("sss", $st_content, $st_op, $st_mid);

		$st_content = $content;
		$st_op = $op;
		$st_mid = $mid;

		$stmnt->execute();
		
		echo "<b>Comment : </b>".$content."<br>By : ".$op."<br><br>";			
	}

	function getComment_Article($conn, $op) {

		$stmnt = $conn->prepare("SELECT * FROM posts WHERE op=? AND mid IS NOT NULL");
		$stmnt->bind_param("s", $st_op);

		$st_op = $op;

		$stmnt->execute();
		$results = $stmnt->get_result();

		while ($row = $results->fetch_assoc())
			echo "<b>Comment : </b>".$row['content']."<br>";
	}

	function showComment_Article($conn, $mid) {

		$stmnt = $conn->prepare("SELECT * FROM posts WHERE mid=?");
		$stmnt->bind_param("s", $st_mid);

		$st_mid = $mid;

		$stmnt->execute();
		$results = $stmnt->get_result();

		while ($row = $results->fetch_assoc())
			echo "<b>Comment : </b>".$row['content']."<br>By : ".$row['op']."<br><br>";			
	}
}