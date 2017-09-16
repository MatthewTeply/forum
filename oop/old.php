<?php 
	include 'db.inc.php';
	include 'posts.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<style type="text/css"> input {display: block; margin: 10px;} </style>

<?php if (isset($_GET['art'])): showArt($conn); ?>
	<div id="article_comment_div"><?php showComment_Art($conn);  ?></div>

	<?php if (isset($_SESSION['oop_uid'])): ?>
		
		<form id="form_comment_art">
			<textarea id="content_comment_art"></textarea>
			<input type="hidden" id="mid_comment_art" value=<?php echo $_GET['art']; ?>>
			<button type="submit" id="subm_comment_art">Comment</button>
		</form>

		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="jq.js"></script>

	<?php else: ?>

		<a href="index.php">Sign in</a> to comment!

	<?php endif ?>

<?php else: ?>

	<h1>All posts</h1>
	<?php showContent($conn); ?>

	<h1>Search for users : </h1>
	<form id="form_user_search">
		<input type="text" id="uid_user_search">
		<button type="submit" id="subm_user_search">Search</button>
	</form>

	<?php /*=MAIN PAGE - NO USER=*/ if (!isset($_SESSION['oop_uid'])): ?>
	<h1>Sign up</h1>
	<form action="signup.inc.php" method="POST">
		<input type="text" name="uid" placeholder="Username">
		<input type="password" name="pwd" placeholder="Password">
		<input type="email" name="em" placeholder="E-mail">
		<button type="submit">Sign Up</button>
	</form>
	<br>
	<h1>Sign in</h1>
	<form action="signin.inc.php" method="POST">
		<input type="text" name="uid" placeholder="Username">
		<input type="password" name="pwd" placeholder="Password">
		<button type="submit">Sign In</button>
	</form>

	<?php /*=MAIN PAGE - USER=*/ else: ?>

	<h1 id="user_heading"><?php echo($_SESSION['oop_uid']); ?></h1>
	<a href="signout.inc.php">Logout</a>
	<br>
	<h2>Post</h2>
	<form id="post_form">
		<textarea id="post_content" placeholder="Content..."></textarea>
		<button type="submit" id="content_subm">Post</button>	
	</form>
	<br>
	<h2>Your posts :</h2>

	<div id="user_posts">
		<?php getContent($conn); ?>
	</div>	
	<br>

	<h2>Your comments : </h2>
	<div id="user_comments">
		<?php getComment_Art($conn); ?>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="jq.js"></script>

	<?php endif ?>

<?php endif ?>

</body>
</html>