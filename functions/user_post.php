<?php 
	session_start();
	if(!isset($_SESSION['uid']))
	{
		header("location:../index.php");
		exit();
	}
	if(isset($_POST['post']) && isset($_SESSION['uid']))
	{
		include_once('../include/dbConnect.php');
		$connect=databaseConnect();
		$uid=$_SESSION['uid'];
		$postContent=addslashes($_POST['postcontent']);
		$postImage=$_FILES['postimage']['name'];
		if($postContent==="" && $postImage==="")
		{
			?>
			<script type="text/javascript">
				alert('Your post is empty.');
				window.open('../home.php?uid=<?php echo $_SESSION['uid']; ?>','_self');
			</script>
			<?php
			exit();
		}
		elseif($postImage!=="")
		{
			$tmp_postImg=$_FILES['postimage']['tmp_name'];
			echo $tmp_postImg;
			move_uploaded_file($tmp_postImg, "../users/post_image/$postImage");
			$post_query="insert into `post`(`user_id`,`post_content`,`post_image`,`post_date`) values ('$uid','$postContent','$postImage',NOW())";
			$run_post_query=mysqli_query($connect,$post_query);
		}
		else
		{
			$post_query="insert into `post`(`user_id`,`post_content`,`post_date`) values ('$uid','$postContent',NOW())";
			$run_post_query=mysqli_query($connect,$post_query);
		}
		header("location:../home.php?uid=$uid");
		exit();
	}
?>