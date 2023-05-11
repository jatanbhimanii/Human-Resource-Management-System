<?php
include_once('connect.php');
session_start();
$session_id = $_SESSION['admin_id'];
if($_SESSION['admin_id']=='') {
    header("Location:login.php");
    exit;
}

if (isset($_POST['save'])) {
    $holiday_name = $_POST['holiday_name'];
    $date = $_POST['date'];

    $query = "INSERT INTO holiday(holiday_name,date) VALUES ('$holiday_name','$date')";
    $query_run = mysqli_query($con,$query) or die(mysqli_error($con));
    if ($query_run) {
        header("Location: ../core/admin_holiday.php");
        echo '<script>alert("Holiday added!");</script>';
    }
    else{
        echo '<script>alert("Holiday not added!")</script>';
    }
}
?>