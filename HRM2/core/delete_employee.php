<?php
include('connect.php');
session_start();
$session_id = $_SESSION['admin_id'];
if($_SESSION['admin_id']=='') {
    header("Location:login.php");
    exit;
}
$delete = $_REQUEST['uid'];

$sql = "delete from userprofile where uid = '$delete'";  
$sql1 = "delete from bank_details where emp_id = '$delete'";
$sql2 = "delete from credentials where id = '$delete'";  
$sql3 = "delete from documents where emp_id = '$delete'";  
$sql4 = "delete from requestforleave where emp_id = '$delete'";  
$sql5 = "delete from request_data where emp_id = '$delete'";
$sql6 = "delete from master_leave where emp_id = '$delete'";  

$result = mysqli_query($con, $sql); 
$result1 = mysqli_query($con, $sql1); 
$result2 = mysqli_query($con, $sql2); 
$result3 = mysqli_query($con, $sql3); 
$result4 = mysqli_query($con, $sql4); 
$result5 = mysqli_query($con, $sql5); 
$result6 = mysqli_query($con, $sql6);  
header("Location:list_employee.php");
exit;
?>
