<?php
	session_start();
	if(isset($_SESSION['uid']))
	{
		$uid=$_SESSION['uid'];
		header("location: ../home.php?uid=$uid");
		exit();
	}
	if(!isset($_POST['signup']))
	{
		header("location: ../index.php");
		exit();
	}
	include_once('../include/dbConnect.php');
	$connect=databaseConnect();
	if(isset($_POST['signup']))
	{
		$name=mysqli_real_escape_string($connect,$_POST['name']);
		$gender=mysqli_real_escape_string($connect,$_POST['gender']);
		$country=mysqli_real_escape_string($connect,$_POST['country']);
		$dob=mysqli_real_escape_string($connect,$_POST['dob']);
		$email=mysqli_real_escape_string($connect,$_POST['email']);
		$password=mysqli_real_escape_string($connect,$_POST['password']);
		$re_password=mysqli_real_escape_string($connect,$_POST['re-enter-password']);
		$status="unverified";
		$ver_code=mt_rand();
		$posts="no";
		if($gender==="null")
		{
			?>
			<script type="text/javascript">
				alert('Please select your gender.');
				window.open('../index.php','_self');				
			</script>
			<?php
			exit();
		}
		elseif(strlen($password)<5)
		{
			?>
			<script type="text/javascript">
				alert('Your password is too short. Please give a strong password.');
				window.open('../index.php','_self');
			</script>
			<?php
			exit();
		}
		elseif($password!==$re_password)
		{
			?>
			<script type="text/javascript">
				alert("Password and Re-enter password isn't matching. Please check carefully.");
				window.open('../index.php','_self');
			</script>
			<?php
			exit();
		}
		$check_email="select * from user where `user_email`='$email'";
		$run_check_email=mysqli_query($connect,$check_email);
		$nrows=mysqli_num_rows($run_check_email);
		if($nrows>0)
		{
			?>
			<script type="text/javascript">
				alert('Your email already exists. Please use another one.');
				window.open('../index.php','_self');
			</script>
			<?php
			exit();
		}
		else
		{
			if($gender==='male')
			{
				$insert_query="insert into `user`(`user_name`,`user_pass`,`user_email`,`user_country`,`user_gender`,`user_dob`,`user_image`,`user_reg_date`,`user_status`,`user_ver_code`,`user_posts`) values ('$name','$password','$email','$country','$gender','$dob','user-default-male.png',NOW(),'$status','$ver_code','$posts')";
			}
			elseif($gender==='female')
			{
				$insert_query="insert into `user`(`user_name`,`user_pass`,`user_email`,`user_country`,`user_gender`,`user_dob`,`user_image`,`user_reg_date`,`user_status`,`user_ver_code`,`user_posts`) values ('$name','$password','$email','$country','$gender','$dob','user-default-female.png',NOW(),'$status','$ver_code','$posts')";
			}
			$run_insert_query=mysqli_query($connect,$insert_query);
			if($run_insert_query)
			{
				?>
				<script type="text/javascript">
					alert('Congratulations. Sign-up is almost complete. Please check your email for further verification.');
					window.open('../index.php','_self');
				</script>
				<?php
				exit();
			}
		}
	}
?>