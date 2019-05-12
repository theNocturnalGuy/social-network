<?php 
	session_start();
	if(!isset($_SESSION['uid']))
	{
		header("location:../index.php");
		exit();
	}
	elseif(isset($_SESSION['uid']) && (!$_POST))
	{
		$uid=$_SESSION['uid'];
		header("location:../home.php?uid=$uid");
		exit();
	}
	else
	{
		include_once('../include/dbConnect.php');
		$connect=databaseConnect(); 
		$nCmnt=$_POST['nCmnt'];
		$postid=$_POST['postid'];
		$postnum=$_POST['postnum'];
	?>
	<label class="label-load" id="btn-loadcmnt" onclick="loadMoreComments(<?php echo $postid; ?>,<?php echo $postnum; ?>,1);">Read comments</label>
	<br clear="all"/><br/>
	<?php
		if($nCmnt===0)
			$getCmnt="select `cmnt_auth`,`cmnt_date`,`cmnt_cont` from `comment` where `post_id`='$postid' order by `cmnt_date` desc limit $nCmnt";
		else
			$getCmnt="select `cmnt_auth`,`cmnt_date`,`cmnt_cont` from `comment` where `post_id`='$postid' order by `cmnt_date` desc";
		$run_getCmnt=mysqli_query($connect,$getCmnt);
		if($run_getCmnt)
		{
			while($comments=mysqli_fetch_assoc($run_getCmnt))
			{
				$cmntAuth=$comments['cmnt_auth'];
				$cmntDate=$comments['cmnt_date'];
				$cmntCont=$comments['cmnt_cont'];
				?>
				<label class="comment-wrapper">
					<label class="comment-details">
						<?php echo $cmntAuth; ?> commented on <?php echo $cmntDate; ?> : 
					</label>
					<?php echo $cmntCont; ?>
				</label><br/><br/ >
				<?php
			}
		}
		exit();
	}
?>			
