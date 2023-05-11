<?php
    include_once('connect.php');
    error_reporting(0);
    session_start();
$session_id = $_SESSION['admin_id'];
if($_SESSION['admin_id']=='') {
    header("Location:login.php");
    exit;
}
//   stores the last row of database into variable named query
    
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>EightTech - HRM</title>
    <!-- contains all header links -->
    <?php include '../core/header.php';?>
    <!--For XML Table-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <!-- contains all css and js files  -->
    <link rel="stylesheet" href="../assets/css/approve.css">
    <script src="../assets/js/viewleaverequest.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- contains code for side navigation bar  -->
            <?php include '../core/sidenav.php';?>
            <script src="../assets/js/sidenav.js"></script>
            <div class="col-9">

                <!-- view leave request card starts  -->
                <div class="card">
                    <div class="card-title">
                        <h5>Approved Leave Request</h5>
                    </div>
                    <div class="card-body">
                        <table id="table1" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Requested By</th>
                                    <th>Reason for Leave</th>
                                    <th>No of days</th>
                                    <th class="ac">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- fetches query result into variable a  -->  
                            <?php 
                                $cnt=1;    
                                $query = "select * from requestforleave,requeststatus where id = requeststatus.approved_id and emp_id= '$session_id'";
                                $result = mysqli_query($con,$query) or die(mysqli_error($con));
                                while($a = mysqli_fetch_assoc($result)){
                                    $query1 = "select username from userprofile where uid =" .$a['emp_id'];
                                    $result1 = mysqli_query($con,$query1);
                                    $b = mysqli_fetch_assoc($result1); 
                            ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $b['username']; ?></td>
                                    <td><?php if($a['leave_id']==1) echo "Personal Leave";
                                              elseif($a['leave_id']==2) echo "Casual Leave";
                                              else echo "Sick Leave"; ?></td>
                                    <td><?php echo $a['days']; ?></td>
                                    <td>
                                        <button onclick="document.getElementById('myModal<?php echo $cnt ?>').style.display='block'">View</button>
                                        <div id="myModal<?php echo $cnt ?>" class="modal" >
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>Leave Details</h2>
                                                    <span onclick="document.getElementById('myModal<?php echo $cnt ?>').style.display='none'" class="clbtn" style="margin-top: 3px;">&times;</span>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h3>From:</h3>
                                                            <input type="text" value="<?php echo $a['from_date']; ?>" disabled>
                                                        </div>
                                                        <div class="col">
                                                            <h3>To:</h3>
                                                            <input type="text" value="<?php echo $a['to_date']; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <h3 style="margin-top: 15px;">Leave Counter</h3>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h3>PL</h3>
                                                            <input type="text" value="<?php if($a['leave_id']==1) echo $a['days'];
                                                            elseif($a['leave_id']==2) echo "0";
                                                            else echo "0"; ?>" disabled>
                                                        </div>
                                                        <div class="col">
                                                            <h3>CL</h3>
                                                            <input type="text" value="<?php if($a['leave_id']==2) echo $a['days'];
                                                            elseif($a['leave_id']==1) echo "0";
                                                            else echo "0"; ?>" disabled>
                                                        </div>
                                                        <div class="col">
                                                            <h3>SL</h3>
                                                            <input type="text" value="<?php if($a['leave_id']==3) echo $a['days'];
                                                            elseif($a['leave_id']==1) echo "0";
                                                            else echo "0"; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="Info">
                                                        <h3>Total</h3>
                                                        <input type="text" value="<?php echo $a['days']?>">
                                                        <h3>Remarks</h3>
                                                        <textarea name="text" placeholder="Remarks" disabled></textarea>
                                                        <h3>Reason</h3>
                                                        <textarea name="text" placeholder="<?php echo $a['message']; ?>" disabled></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            $cnt=$cnt+1; 
                            } 
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card card-1">
                    <div class="card-title">
                        <h5>Rejected Leave Request</h5>
                    </div>
                    <div class="card-body">
                        <table id="table2" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Requested By</th>
                                    <th>Reason for Leave</th>
                                    <th>No of days</th>
                                    <th class="ac">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- fetches query result into variable a  -->  
                            <?php 
                                $cnt=1;
                                $query = "select * from requestforleave,requeststatus where id = requeststatus.rejected_id and emp_id='$session_id'";
                                $result = mysqli_query($con,$query) or die(mysqli_error($con));
                                while($a = mysqli_fetch_assoc($result)){
                                    $query1 = "select username from userprofile where uid =" .$a['emp_id'];
                                    $result1 = mysqli_query($con,$query1);
                                    $b = mysqli_fetch_assoc($result1);
                            ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $b['username']; ?></td>
                                    <td><?php if($a['leave_id']==1) echo "Personal Leave";
                                              elseif($a['leave_id']==2) echo "Casual Leave";
                                              else echo "Sick Leave"; ?></td>
                                    <td><?php echo $a['days']; ?></td>
                                
                                    <td>
                                        <button onclick="document.getElementById('myModal1<?php echo $cnt ?>').style.display='block'">View</button>
                                        <div id="myModal1<?php echo $cnt ?>" class="modal" >
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>Leave Details</h2>
                                                    <span onclick="document.getElementById('myModal1<?php echo $cnt ?>').style.display='none'" class="clbtn" style="margin-top: 3px;">&times;</span>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h3>From:</h3>
                                                            <input type="text" value="<?php echo $a['from_date']; ?>" disabled>
                                                        </div>
                                                        <div class="col">
                                                            <h3>To:</h3>
                                                            <input type="text" value="<?php echo $a['to_date']; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <h3 style="margin-top: 15px;">Leave Counter</h3>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h3>PL</h3>
                                                            <input type="text" value="<?php if($a['leave_id']==1) echo $a['days'];
                                                            elseif($a['leave_id']==2) echo "0";
                                                            else echo "0"; ?>" disabled>
                                                        </div>
                                                        <div class="col">
                                                            <h3>CL</h3>
                                                            <input type="text" value="<?php if($a['leave_id']==2) echo $a['days'];
                                                            elseif($a['leave_id']==1) echo "0";
                                                            else echo "0"; ?>" disabled>
                                                        </div>
                                                        <div class="col">
                                                            <h3>SL</h3>
                                                            <input type="text" value="<?php if($a['leave_id']==3) echo $a['days'];
                                                            elseif($a['leave_id']==1) echo "0";
                                                            else echo "0"; ?>" disabled>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="Info">
                                                        <h3>Total</h3>
                                                        <input type="text" value="<?php echo $a['days']?>">
                                                        <h3>Remarks</h3>
                                                        <textarea name="text" placeholder="Remarks" disabled></textarea>
                                                        <h3>Reason</h3>
                                                        <textarea name="text" placeholder="<?php echo $a['message']; ?>" disabled></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            $cnt=$cnt+1; 
                            } 
                            ?>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../core/footer.php';?>
</body>
</html>