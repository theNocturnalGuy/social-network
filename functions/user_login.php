<?php 
	session_start();
	if(isset($_SESSION['uid']))
	{
		$uid=$_SESSION['uid'];
		header("location: ../home.php?uid=$uid");
		exit();
	}
	if(!isset($_POST['login']))
	{
		header("location: ../index.php");
		exit();
	}
	include_once('../include/dbConnect.php');
	$connect=databaseConnect();
	if(isset($_POST['login']))
	{
		$username=mysqli_real_escape_string($connect,$_POST['email']);
		$password=mysqli_real_escape_string($connect,$_POST['password']);
		$loginData="select * from user where `user_email`='$username' AND `user_pass`='$password'";
		$run_loginData=mysqli_query($connect,$loginData);
		$nrows=mysqli_num_rows($run_loginData);
		if($nrows<1)
		{
			?>
			<script type="text/javascript">
				alert('Incorrect Username or Password.');
				window.open('../index.php','_self');
			</script>
			<?php
			exit();
		}
		else
		{
			$fetchedData=mysqli_fetch_assoc($run_loginData);
			$uid=$fetchedData['user_id'];
			$_SESSION['uid']=$uid;
			header("location: ../home.php?uid=$uid");
		}
	}
?>