<?php
include('connect.php');
session_start();
$session_id = $_SESSION['admin_id'];
if($_SESSION['admin_id']=='') {
    header("Location:login.php");
    exit;
}
$id = $_REQUEST['id'];
    $query1 = "INSERT INTO requeststatus(rejected_id) VALUES ('$id')";
    $query_run1 = mysqli_query($con,$query1);
    if($query_run1)
    { 
        echo '<script>window.location.href="../core/approve_admin.php"</script>';
        echo '<script>alert("Leave Rejected Successfully!")</script>';
    }
    else {
        echo '<script>alert("Action Not Taken!")</script>';
    }
?>