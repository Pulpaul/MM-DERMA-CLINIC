<?php
include 'connection.php';
$a_id = $_GET['id'];
$sql = "UPDATE appointment SET status = 'Approved' WHERE id = '$a_id' ";
mysqli_query($conn,$sql);
header('Location: ../admin/home.php');

?>