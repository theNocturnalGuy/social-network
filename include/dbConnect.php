<?php  
	function databaseConnect(){
		$connect=mysqli_connect('localhost','root','','social_network');
		if(!$connect)
			echo "Database connection is not established";
		else
			return $connect;
	}	
?>