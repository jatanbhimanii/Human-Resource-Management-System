<?php
include('connect.php');
session_start();
$session_id = $_SESSION['admin_id'];
if($_SESSION['admin_id']=='') {
    header("Location:login.php");
    exit;
}
$id = $_REQUEST['id'];
$query = "INSERT INTO requeststatus(approved_id) VALUES ('$id')";
$q ="select * from requestforleave left join requeststatus on requestforleave.id = requeststatus.approved_id or requestforleave.id = requeststatus.rejected_id where approved_id=$id;"; 
$query_run = mysqli_query($con,$query) or die ( mysqli_error($con));
$q_run = mysqli_query($con,$q) or die ( mysqli_error($con));
$a = mysqli_fetch_assoc($q_run);
$leave_id = $a['leave_id'];
$emp_id = $a['emp_id'];
$days = $a['days'];
if($q_run && $query_run){

    if($leave_id==1){
        $query1 = "INSERT INTO master_leave (emp_id,pl,cl,sl) VALUES ('$emp_id','$days','0','0') ON DUPLICATE KEY UPDATE  pl = pl + '$days'";
    }
    elseif($leave_id==2){
        $query1 = "INSERT INTO master_leave (emp_id,pl,cl,sl) VALUES ('$emp_id','0','$days','0') ON DUPLICATE KEY UPDATE  cl = cl + '$days'";
    }
    elseif($leave_id==3){
        $query1 = "INSERT INTO master_leave (emp_id,pl,cl,sl) VALUES ('$emp_id','0','0','$days') ON DUPLICATE KEY UPDATE  sl = sl + '$days'";
    }
        $query_run1 = mysqli_query($con,$query1) or die( mysqli_error($con));

        
    
        if($query_run1)
        { 
            echo '<script>window.location.href="../core/approve_admin.php"</script>';
            echo '<script>alert("Leave Approved Successfully!")</script>';
        }
        else {
            echo '<script>alert("Action Not Taken!")</script>';
        }
    
}



?>
