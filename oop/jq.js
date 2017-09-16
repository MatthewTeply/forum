$(document).ready(function() {

	//=SET CONTENT=
	$("#post_form").submit(function(e) {
		e.preventDefault();

		var post_content = $("#post_content").val();

		$.ajax({

			method: "POST",
			data: {content:post_content, setContent_call:true},
			url: "posts.inc.php",
			success: function(response) {

				$("#user_posts").append(post_content);
			},
			error: function() {

				alert("There was an error posting your message!");
			}
		});
	});

	//=GET CONTENT=
	setInterval(function() {

		$.ajax({

			method: "POST",
			data: {getContent_call:true},
			url: "posts.inc.php",
			success: function(response) {

				$("#user_posts").html(response);
			}
 		});

	}, 5000);

	//=SET COMMENT=
	$("#form_comment_art").submit(function(e) {
		e.preventDefault();

		var comment = $("#content_comment_art").val();
		var master_id = $("#mid_comment_art").val();

		$.ajax({

			method: "POST",
			data: {setComment_call:true, content:comment, mid:master_id},
			url: "posts.inc.php",
			success: function(response) {

				$("#article_comment_div").append(response);
				$("#content_comment_art").val("");
			},
			error: function() {

				alert("There was an error proccessing your comment!");
			}
		});

	});

	//=GET USER=
	$("#form_user_search").submit(function(e) {
		e.preventDefault();

		var username = $("#uid_user_search").val();

		$.ajax({

			method: "POST",
			url: "users.inc.php",
			data: {showUsr_call:true ,uid:username},
			success: function(response) {

				alert(response);
			}
		});

	});
});