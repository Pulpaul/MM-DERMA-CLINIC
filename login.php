<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link type="text/css" rel="stylesheet" href="css/font-awesome.css">

</head>
<body>

		<div class="pangalan">
			<h1><i class="fa fa-medkit"></i></h1><h2>MM DERMATOLOGY CLINIC RESERVATION</h2>
		</div>

		<div class="header">
			<h2><i class="fa fa-sign-in"></i> SIGN-IN</h2>
		</div>
	<form method="post" action="login.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password" >
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn"><i class="fa fa-sign-in"></i> SIGN-IN</button>
		</div>
		<p>
			Not yet a member? <a href="register.php" class="btn" style="text-decoration: none;"><i class="fa fa-user-plus"></i> SIGN-UP</a>
		</p>
	</form>
	

</body>
</html>