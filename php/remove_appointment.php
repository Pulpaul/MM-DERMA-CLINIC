<?php
include 'connection.php';
$a_id = $_GET['id'];
$sql = "DELETE FROM appointment WHERE id = '$a_id' ";
mysqli_query($conn,$sql);
header('Location: ../admin/home.php');

?>