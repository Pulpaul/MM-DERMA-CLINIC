<?php 
	$date_error = "";
	$success = "";
	include('functions.php');
	
	if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}	
	$a_id = $_GET['id'];
	$query = "SELECT * FROM appointment WHERE id = '$a_id' ";
	$result = mysqli_query($db,$query);
	$fetch = mysqli_fetch_array($result);
	
	if (isset($_POST['set_app'])) {
		$doctor = mysqli_escape_string($db, $_POST['doctor']);
		$problem = mysqli_escape_string($db, $_POST['problem']);
		$time = $_POST['time'];
		$the_time = date('h:i A', strtotime($time));
		$date = mysqli_escape_string($db, $_POST['date']);
		$now = date('Y-m-d'); 
		$client_id = $_SESSION['user']['id'];
		

		if ($date < $now) {
			$date_error = "<div class='alert alert-danger'>Set advance date.</div>";
		}
		else {
			$sql = "UPDATE appointment set doctor = '$doctor', problem = '$problem', timess = '$the_time', dates = '$date' "; 
			mysqli_query($db,$sql);
			$success = "<div class='alert alert-success'>Updating Appointment Successfull.</div>";
		} 
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
</head>
<body style="background-color: #EEE;">
	<nav class="navbar navbar-inverse" style="background-color: pink; padding: 10px 10px;">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>                        
	      </button>
	      <a class="navbar-brand" style="color: white;"><i class="fa fa-medkit"></i> MM DERMATOLOGY CLINIC</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-center">
	        <li style="border-style: inset; border: 1px white;"><a  href="index.php">HOME</a></li> 
	      </ul> 
	      <ul class="nav navbar-nav navbar-right">
	      	<li><a href="" style="color: white; cursor: default;"><?php echo $_SESSION['user']['username']; ?></a></li>
		      <li><a href="edit_appointment.php?logout='1'"><span class=" fa fa-sign-out"></span> LOG-OUT</a></li>
		    </ul>
	    </div>
	  </div>
	</nav>
 

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-danger">
				    <div class="panel-heading">PANEL</div>
					<div class="panel-body">
						<a href="index.php" class="btn btn-link"> <i class="fa fa-mail-reply"></i> BACK</a>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-danger">
				    <div class="panel-heading"><i class="fa fa-edit"></i> EDIT APPOINMENT</div>
					<div class="panel-body">
						<?php echo $success; ?>
						<?php echo $date_error; ?>
						<form method="POST" action="create_appointment.php">
							<div class="form-group">
							  <label for="sel1">DOCTOR</label>
							  <select class="form-control" name="doctor" required="">
							  	<option><?php echo $fetch['doctor']; ?></option>
							    <option>Dr. Kwak Kwak</option>
							    <option>Dr. Bangi</option>
							    <option>Dr. Kulikot</option>
							    <option>Dr. Bello</option>
							  </select>
							</div>
							<div class="form-group">
							  <label for="usr">DESCRIPTION</label>
							  <textarea class="form-control" name="problem" rows="3" required=""><?php echo $fetch['problem']; ?></textarea>
							</div>
							<div class="form-group">
							  <label for="usr">TIME</label> 
							  <input type="time" class="form-control" name="time" required="" value="<?php $date = date("H:i", strtotime($fetch['timess'])); echo "$date"; ?>">
							</div>
							<div class="form-group">
							  <label for="pwd">DATE</label>
							  <input type="date" class="form-control" name="date" required="" value="<?php echo $fetch['dates']; ?>">
							</div> 
					</div>
					<div class="panel-footer">
						<button type="submit" name="set_app" class="btn btn-success">UPDATE APPOINTMENT</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="js/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="js/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> 
</body>
</html>