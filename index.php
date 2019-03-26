<?php 
	include('functions.php');
	
	if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
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
		      <li><a href="index.php?logout='1'"><span class=" fa fa-sign-out"></span> LOG-OUT</a></li>
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
						<a href="create_appointment.php" class="btn btn-link"><i class="fa fa-calendar-plus-o"></i> CREATE APPOINTMENT</a>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-danger">
				    <div class="panel-heading"><i class="fa fa-calendar"></i> YOUR APPOINMENTS</div>
				    <div class="panel-body">
				    	<table id="ap_list" class="table table-hover">
							<thead>
								<tr>
									<th>DOCTOR</th>
									<th>DESCRIPTION</th>
									<th>TIME</th>
									<th>DATE</th>
									<th>STATUS</th>
									<th>OPTION</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$c_id = $_SESSION['user']['id'];
									$sql = "SELECT * FROM appointment WHERE client_id = '$c_id' ";
									$result = mysqli_query($db,$sql);
									while ($row = mysqli_fetch_array($result))
									{
								?>
								<tr>
									<td><?php echo $row['doctor'];?></td>
									<td><?php echo $row['problem'];?></td>
									<td><?php echo $row['timess'];?></td>
									<td><?php echo $row['dates'];?></td>
									<td><?php
											$status = $row['status'];
											if ($status == 'Pending') {
												echo "<span class='label label-warning'>";
												echo $row['status']; 
												echo "</span>";
											}
											elseif ($status == 'Approved') {
												echo "<span class='label label-success'>";
												echo $row['status']; 
												echo "</span>";
											}
										?>
									</td>
									<td><a href="edit_appointment.php?id=<?php echo $row['id'] ?>" class="btn btn-success btn-sm" style="border-radius: 1000px;" data-toggle="tooltip" data-placement="top" title="EDIT"><i class="fa fa-edit"></i></a>
										<a href="php/delete_appointment.php?id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm" style="border-radius: 1000px;" data-toggle="tooltip" data-placement="top" title="DELETE"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
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
    <script>
	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();   
	});
	</script>
	<script>
      $(function () {
        $('#ap_list').DataTable()
        $('#').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false
        })
      })
    </script>
</body>
</html>