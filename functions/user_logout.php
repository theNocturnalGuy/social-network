<?php 
	session_start();
	if(isset($_POST['logout']))
	{
		session_destroy();
		header("location: ../index.php");
		exit();
	}
	if(isset($_SESSION['uid']) && !isset($_POST['logout']))
	{
		$uid=$_SESSION['uid'];
		header("location: ../home.php?uid=$uid");
		exit();
	}
	if(!isset($_SESSION['uid']))
	{
		header("location: ../index.php");
		exit();
	}
?>