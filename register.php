<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link type="text/css" rel="stylesheet" href="style.css">
	<link type="text/css" rel="stylesheet" href="css/font-awesome.css">
</head>
<body>
<div class="header">
	<h2><i class="fa fa-user-plus"></i> SIGN-UP</h2>
</div>
<form method="post" action="register.php">
	<?php echo display_error(); ?>
	<?php echo $okay; ?>
	<div class="input-group">
		<label>First Name</label>
		<input type="text" name="firstname" maxlength="20" required>
	</div>
	<div class="input-group">
		<label>Last Name</label>
		<input type="text" name="lastname" maxlength="20" required>
	</div>
	<div class="input-group">
		<label>Address</label>
		<input type="text" name="address" maxlength="20" required>
	</div>
	<div class="input-group">
		<label>Contact Number</label>
		<input type="number" name="number" maxlength="11" required>
	</div>
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" pattern="[1-0a-zA-Z]" maxlength="20" required>
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" required>
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1" reqiured>
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2" rquired>
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn"><i class="fa fa-user-plus"></i> SIGN-UP</button>
	</div>
	<p>
		Already a member? <a href="login.php" class="btn" style="text-decoration: none;"><i class="fa fa-sign-in"></i> SIGN-IN</a>
	</p>
</form>
</body>
</html>