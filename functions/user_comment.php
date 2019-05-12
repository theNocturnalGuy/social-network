<?php
	session_start();
	if(!isset($_SESSION['uid']))
	{
		header("location:../index.php");
		exit();
	}
	if(isset($_POST) && isset($_SESSION['uid']))
	{
		include_once('../include/dbConnect.php');
		$connect=databaseConnect();
		$uid=$_SESSION['uid'];
		$postid=$_POST['post-id'];
		$commentAuth=$_POST['cmnt-auth'];
		$commentContent=addslashes($_POST['cmnt-content']);
		if($commentContent=="")
		{
			?>
			<script type="text/javascript">
				alert('Your post is empty.');
				window.open('../home.php?uid=<?php echo $_SESSION['uid']; ?>','_self');
			</script>
			<?php
		}
		else
		{
			$comment_query="insert into `comment`(`post_id`,`user_id`,`cmnt_auth`,`cmnt_cont`,`cmnt_date`) values ('$postid','$uid','$commentAuth','$commentContent',NOW())";
			$run_comment_query=mysqli_query($connect,$comment_query);
		}
		header("location:../home.php?uid=$uid");
		exit();
	}
?>