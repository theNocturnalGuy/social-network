<?php 
	session_start();
	if(isset($_SESSION['uid']))
	{
		$uid=$_SESSION['uid'];
		header("location: home.php?uid=$uid");
		exit();
	}
	$title='Social Networking Site';
	$cssPath_1='styles/index_style.css';
	$cssPath_2='';
	include_once('template/header.php');
?>
	<body>
		<header>
			<button id="btn-login" onclick="openModalLogin();"></button><br clear="all"/>
		</header>
		<div class="wrapper">
			<div class="banner">
				<h1>Social<br/> Networking<br/> Site</h1>
			</div>
		</div>	
		<div class="modal-wrapper" id="modal-wrapper">
			<div class="modal-login" id="modal-login">
				<button id="btn-close" onclick="closeModalLogin();">&times;</button>
				<h1>User Log In</h1>
				<center>
					<form method="post" action="functions/user_login.php" name="login-form">
						<input type="email" name="email" placeholder="Email" maxlength="30" required="required"/><br/>
						<input type="password" name="password" placeholder="Password" minlength="5" maxlength="30" required="required"/><br/>
						<center><button name="login" id="btn-login">Log In</button></center>
					</form>
				</center>
				<span class="line">________________________<span class="inline-text">or</span>_________________________</span>
				<center>
					<h5>New User ? Create Account Here.</h5>
					<button name="signup" id="btn-signup" onclick="openModalSignup();">Sign Up</button>
				</center>
			</div>
			<div class="modal-signup" id="modal-signup">
				<button id="btn-close" onclick="closeModalSignup();">&times;</button>
				<h1>Sign Up Here</h1>
				<center>
					<form method="post" action="functions/user_signup.php" name="signup-form" onsubmit="return signup_formValidate();">
						<label>Name : <input type="text" name="name" maxlength="25" required="required"/></label><br/>
						<label>Gender : <select required="required" name="gender"> 
							<option selected="selected" value="null">--select--</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select></label><br/>
						<label>Country : <input type="text" name="country" maxlength="25" required="required"/></label><br/>
						<label>Date of Birth : <input type="date" name="dob" required="required"/></label><br/>
						<label>Email : <input type="email" name="email" maxlength="30" required="required"/></label><br/>
						<label>Password : <input type="password" name="password" minlength="5" maxlength="30" required="required"/></label><br/>
						<label>Re-enter Password : <input type="password" name="re-enter-password" minlength="5" maxlength="30" required="required"/></label><br/>
						<button name="signup" id="btn-signup">Sign Up</button>
					</form>
				</center>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="scripts/index_script.js"></script>
</html>