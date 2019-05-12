<?php
	session_start();
	if(!isset($_SESSION['uid']))
	{
		header("location: index.php");
		exit();
	}
	include_once('include/dbConnect.php');
	$connect=databaseConnect();
	$uid=$_GET['uid'];
	$get_userData="select `user_name`, `user_image` from user where `user_id`='$uid'";
	$run_get_userData=mysqli_query($connect,$get_userData);
	$nrows=mysqli_num_rows($run_get_userData);
	if($nrows>0)
	{
		$userData=mysqli_fetch_assoc($run_get_userData);
		$title=$userData['user_name']." | Home";
	}
	$cssPath_1='styles/user_style.css';
	$cssPath_2='styles/home_style.css';
	include_once('template/header.php');
	$fullName=$userData['user_name'];
	$userImage=$userData['user_image'];
	$firstName='';
	for($i=0;$i<strlen($fullName);$i++)
	{
		$ch=substr($fullName,$i,1);
		if($ch!=" ")
			$firstName=$firstName.$ch;
		else
			break;
	}
?>
	<body>
		<header>
			<form method="post">
				<input type="search" name="search" placeholder="Search"/>
			</form>
			<nav>
				<ul>
					<li><center><a href="profile.php?uid=<?php echo $uid; ?>"><img class="user-img" src="users/user_image/<?php echo $userImage; ?>"/><span><?php echo $firstName; ?></span></a></center></li>
					<li><a href="">Home</a></li>
					<li>
						<form method="post" action="functions/user_logout.php">
							<button name="logout" id="btn-logout">Logout</button>
						</form>
					</li>
				</ul>
			</nav>
		</header>
		<div class="content">
			<div class="user-post">
				<center>
					<form name="user-post" method="post" action="functions/user_post.php" enctype="multipart/form-data">
						<label class="label-create">Create Post</label>
						<textarea name="postcontent" placeholder="What's on your mind, <?php echo $firstName." ?"; ?>"></textarea><br/>
						<label class="label-post">
							<label for="file">Photo</label>
							<input type="file" name="postimage">
							<button id="btn-post" name="post">Post</button>
						</label>
					</form>
				</center>
			</div>
			<div class="user-timeline">
				<label class="label-timeline">Timeline</label>
				<?php 
					$getPosts="select user.user_name, user.user_image, post.post_id, post.post_content, post.post_image, post.post_date from `post` inner join `user` on post.user_id=user.user_id order by `post_date` desc";
					$run_getPosts=mysqli_query($connect,$getPosts);
					if($run_getPosts)
					{	
						$postnum=0;
						while ($posts=mysqli_fetch_assoc($run_getPosts))
						{
							$postnum++;
							$postid=$posts['post_id'];
							$getCmntCount="select `cmnt_id` from `comment` where `post_id`='$postid'";
							$run_getCmntCount=mysqli_query($connect,$getCmntCount);
							if($run_getCmntCount)
								$numCmnt=mysqli_num_rows($run_getCmntCount);
							?>
							<div class="posts">
								<label class="post-author"><img class="user-img" src="users/user_image/<?php echo $posts['user_image']; ?>"/><span>Posted by : <a href="#"><?php echo $posts['user_name']; ?></a></span></label>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<label class="post-date">Date : <?php echo $posts['post_date']; ?></label>
								<br/><br/>
								<?php echo $posts['post_content']; ?><br/><br/>
								<?php
									if($posts['post_image'])
										echo "<center><img src='users/post_image/".$posts['post_image']."' id='imgpost'/></center><br/><br/>";
								?>
								<button id="icon-comment" class="icon-comment" onclick="show_hide_CommentBox(<?php echo $postnum; ?>);"><span><?php echo $numCmnt; ?></span></button><br clear="all"/>
								<form class="user-comment">
									<textarea name="cmnt-content"></textarea>
									<input type="hidden" name="post-id" value="<?php echo $postid; ?>"/>
									<input type="hidden" name="cmnt-auth" value="<?php echo $fullName; ?>"/>
									<input name="comment" id="btn-comment" type="submit" value="Comment" onclick="return addComment(<?php echo $postid; ?>,<?php echo $postnum; ?>);" />
								</form><br clear="all"/>
								<div class="comments">	
									<label class="label-load" id="btn-loadcmnt" onclick="loadMoreComments(<?php echo $postid; ?>,<?php echo $postnum; ?>,1); hideCommentCount(<?php echo $postnum; ?>);">Read comments</label>
									<br clear="all" /><br/>						
								</div>
							</div>
							<?php
						}
					}
				?>				
			</div>
			<div class="active-user-wrapper">
				<label>Active Users</label>
				<div class="active-user">
					<ul>
						<?php 
							$getActiveUsers="select user_id, user_name from user";
							$run_getActiveUsers=mysqli_query($connect,$getActiveUsers);
							while($activeUsers=mysqli_fetch_assoc($run_getActiveUsers))
							{
								$uid=$activeUsers['user_id'];
								if(isset($_SESSION['uid']))
								{
									echo "<li>".$activeUsers['user_name']."</li>";
									echo "<script>"."console.log('".$activeUsers['user_name']."');"."</script>";
								}
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="scripts/user_script.js"></script>		
</html>