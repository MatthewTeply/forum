<?php
session_start();

require("classes/posts.class.php");
include 'db.inc.php';

function setContent($conn, $content, $username) {

	if (isset($_SESSION['oop_uid'])) {

		$posts = new posts;
		$posts->setPost($conn, $content, $username);
	}
}

function getContent($conn) {

	$uid = $_SESSION['oop_uid'];

	$posts = new posts;
	echo $posts->getPost($conn, $uid);
}

function showContent($conn) {

	$posts = new posts;
	echo $posts->showPost($conn);
}

function showArt($conn) {

	$article = new posts;
	echo $article->showArticle($conn, $_GET['art']);
}

function setComment_Art($conn, $content, $username, $master_id) {

	$comment = new posts;
	$comment->setComment_Article($conn, $content, $username, $master_id);
}

function getComment_Art($conn) {

	$comment = new posts;
	$comment->getComment_Article($conn, $_SESSION['oop_uid']);
}

function showComment_Art($conn) {

	$comment = new posts;
	echo $comment->showComment_Article($conn, $_GET['art']);
}

//=For Ajax=

//-setContent-
if (isset($_POST['setContent_call']))
	setContent($conn, $_POST['content'], $_SESSION['oop_uid']);

//-getContent-
if (isset($_POST['getContent_call']))
	getContent($conn);

//-SetComment-
if (isset($_POST['setComment_call']))
	setComment_Art($conn, $_POST['content'], $_SESSION['oop_uid'], $_POST['mid']);