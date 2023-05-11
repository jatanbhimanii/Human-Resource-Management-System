<?php
include('connect.php');
session_start();
$session_id = $_SESSION['admin_id'];
if($_SESSION['admin_id']=='') {
    header("Location:login.php");
    exit;
}
$id = $_POST['emp_id'];
$q = "select * from bank_details where emp_id = '$id' ";
$r = mysqli_query($con, $q) or die( mysqli_error($con));
$z = mysqli_fetch_assoc($r);
$qu= "select * from userprofile where uid = '$id' ";
$re = mysqli_query($con, $qu) or die( mysqli_error($con));
$ze = mysqli_fetch_assoc($re);

$data=array();
$data['bank'] = $z['bank_name'];
$data['ifsc'] = $z['ifsc'];
$data['account_number'] = $z['account_number'];
$data['designation'] = $ze['designation'];
echo json_encode($data);
?>
