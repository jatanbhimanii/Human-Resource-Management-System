<?php
include_once('connect.php');
session_start();
$session_id = $_SESSION['admin_id'];
if($_SESSION['admin_id']=='') {
    header("Location:login.php");
    exit;
}
if (isset($_POST['save'])) {
    $designation = $_POST['designation'];

    $query = "INSERT INTO designation(designation_name) VALUES ('$designation')";
    $query_run = mysqli_query($con,$query) or die(mysqli_error($con));

    if ($query_run) {
        header("Location: ../core/designation.php");
        echo '<script>alert("data saved!");</script>';
    }
    else{
        echo '<script>alert("data not saved!")</script>';
    }
}
?>