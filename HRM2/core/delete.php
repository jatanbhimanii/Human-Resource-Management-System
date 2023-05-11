<?php
include('connect.php');
session_start();
$session_id = $_SESSION['admin_id'];
if($_SESSION['admin_id']=='') {
    header("Location:login.php");
    exit;
}
$delete = $_REQUEST['id'];

$sql = "delete from designation where id = '$delete'";  
$result = mysqli_query($con, $sql);  
header("Location:designation.php");
exit;
?>
