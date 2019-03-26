<?php 
session_start();
date_default_timezone_set('Asia/Manila');
$db = mysqli_connect('localhost', 'root', '', 'clinic_db');

$okays = "";
$okay = "";
$username = "";
$email    = "";
$errors   = array(); 

if (isset($_POST['register_btn'])) {
	register();
	$okay = "<a href='login.php'> Register Done! Click this to login </a>";
}

function register(){
	global $db, $errors, $username, $email;

    $firstname    =  e($_POST['firstname']);
	$lastname       =  e($_POST['lastname']);
	$address  =  e($_POST['address']);
	$number  =  e($_POST['number']);
	$user_type  =  e("user");
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	if (count($errors) == 0) {
		$password = md5($password_1);

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (firstname, lastname, address, number, username, email, user_type, password) 
					  VALUES('$firstname','$lastname','$address','$number','$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);


		}else{
			$query = "INSERT INTO users (firstname, lastname, address, number, username, email, user_type, password) 
					  VALUES('$firstname','$lastname','$address','$number','$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);

						
		}
	}
}

function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
if (isset($_POST['login_btn'])) {
	login();
}

function login(){
	global $db, $username, $errors;

	$username = e($_POST['username']);
	$password = e($_POST['password']);

	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { 
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/home.php');	  
			}
			elseif ($logged_in_user['user_type'] == 'support') {
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: support.php');	
			}
			else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: index.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

if (isset($_POST['add_admin'])) {
	register_admin();
	$okays = "<div class='alert alert-success'>Admin Register Complete!</div>";
}

function register_admin(){
	global $db, $errors, $username, $email;

    $firstname    =  e($_POST['firstname']);
	$lastname       =  e($_POST['lastname']);
	$address  =  e($_POST['address']);
	$number  =  e($_POST['number']);
	$user_type  =  e("admin");
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	if (count($errors) == 0) {
		$password = md5($password_1);

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (firstname, lastname, address, number, username, email, user_type, password) 
					  VALUES('$firstname','$lastname','$address','$number','$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);


		}else{
			$query = "INSERT INTO users (firstname, lastname, address, number, username, email, user_type, password) 
					  VALUES('$firstname','$lastname','$address','$number','$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);

						
		}
	}
}