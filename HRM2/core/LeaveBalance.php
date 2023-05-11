<?php
    include_once('connect.php');
    error_reporting(0);
    session_start();
$session_id = $_SESSION['admin_id'];
if($_SESSION['admin_id']=='') {
    header("Location:login.php");
    exit;
}
    $query = "select * from userprofile where uid = '$session_id'";
    $result = mysqli_query($con, $query) or die( mysqli_error($con));
    $query1 = "select sum(pl+cl+sl) as total, pl,cl,sl from master_leave where emp_id = '$session_id'";
    $query = "select * from userprofile where uid ='$session_id'";
    $query0 = "select * from requestforleave where emp_id ='$session_id' order by id DESC";
    $result1 = mysqli_query($con,$query1) or die( mysqli_error($con));
    $result = mysqli_query($con,$query) or die( mysqli_error($con));  
    $result0 = mysqli_query($con,$query0) or die( mysqli_error($con));    
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>EightTech - HRM</title>
    <!-- contains all header links -->
    <?php include '../core/header.php';?>
    <!-- contains all css files  -->
    <link rel="stylesheet" href="../assets/css/LeaveBalance.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- contains code for side navigation bar  -->
            <?php include '../core/sidenav.php';?>
            <script src="../assets/js/sidenav.js"></script>

            <div class="col-9">
                <!-- contains code for logout button  -->
                
                <div class="container">
                    <p class="title">Leave Balance for User</p>
                    <!-- first card starts  -->
                    <?php 
                        $a = mysqli_fetch_assoc($result1);
                        $b = mysqli_fetch_assoc($result);
                        $c = mysqli_fetch_assoc($result0);
                    ?>
                    <div class="card card1">
                        <div class="card-title">
                            <p class="nav">Leave Balance</p>
                        </div>
                        <div class="card-body">
                            <table>
                                <tr>
                                    <th>Personal Leave</th>
                                    <th>Casual Leave</th>
                                    <th>Sick Leave</th>
                                    <th>Total Leave</th>
                                </tr>
                                <tr class="data">
                                    <td><?php echo $a['pl']; ?></td>
                                    <td><?php echo $a['cl']; ?></td>
                                    <td><?php echo $a['sl']; ?></td>
                                    <td><?php echo $a['total']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>
                    <!-- first card ends  -->

                    <!-- second card starts  -->
                    <div class="card">
                        <div class="card-title">
                            <p class="nav">Taken Leave</p>
                        </div>
                        <div class="card-body">
                            <table>
                                <tr>
                                    <th>Leave For</th>
                                    <th>Date</th>
                                    <th>No of Day's</th>
                                    <th>Leave Reason</th>
                                </tr>
                                <tr class="data">
                                    <td><?php if($c['leave_id']==1) echo "Personal Leave";
                                              elseif($c['leave_id']==2) echo "Casual Leave";
                                              elseif($c['leave_id']==3) echo "Sick Leave";
                                              else echo "-"; ?></td>
                                    <td><?php echo $c['from_date']; ?> to <?php echo $c['to_date']; ?> </td>
                                    <td><?php echo $c['days']; ?> </td>
                                    <td><?php echo $c['message']; ?> </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- second card ends  -->

                    <!-- third card starts  -->
                    <p class="title">Leave Balance for Owner</p>
                    <div class="card">
                        <div class="card-title">
                            <p class="nav">Leave Balance</p>
                        </div>
                        <div class="card-body">
                            <table>
                                <tr>
                                    <th>Employee Id</th>
                                    <th>Employee Name</th>
                                    <th>No of Day's (leave)</th>
                                    <th>Leave Available</th>
                                </tr>
                                <tr class="data">
                                    <td><?php echo $b['uid']; ?></td>
                                    <td><?php echo $b['firstname']; ?>&nbsp;<?php echo $b['lastname']; ?></td>
                                    <td><?php echo $a['total']; ?></td>
                                    <td><?php echo 24-$a['total']; ?></td>
                                    
                
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- third card ends  -->
                    <br>
                </div>
            </div>
        </div>
    </div>
   
<?php
?>
</body>
</html>