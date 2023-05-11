<!-- embedes php code from connect.php  -->
<?php
    include_once('connect.php');
    error_reporting(0);
    session_start();
    $session_id = $_SESSION['admin_id'];
    if($_SESSION['admin_id']=='') {
        header("Location:login.php");
        exit;
    }
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
    <link rel="stylesheet" href="../assets/css/viewleaverequest.css">
    <script src="../assets/js/viewleaverequest.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- contains code for side navigation bar  -->
            <?php include '../core/admin_sidenav.php';?>
            <script src="../assets/js/sidenav.js"></script>
            <div class="col-9">
                <!-- view leave request card starts  -->
                <div class="card">
                    <div class="card-title">
                        <h5>View Leave Request</h5>
                    </div>
                    <div class="card-body">
                        <table id="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th style=>Requested By</th>
                                    <th>Reason for Leave</th>
                                    <th>No of days</th>
                                    <th class="ac">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- fetches query result into variable a  -->  
                            <?php 
                                $cnt=1;
                                $join = "select * from requestforleave left join requeststatus on requestforleave.id = requeststatus.approved_id or requestforleave.id = requeststatus.rejected_id";
                                $joinresult = mysqli_query($con,$join) or die(mysqli_error($con));
                                while($info = mysqli_fetch_assoc($joinresult)){
                                    if ($info['approved_id']==$info['id']){
                                        $d = 1;
                                    }
                                    elseif ($info['rejected_id']==$info['id']){
                                        $d = 0;
                                    }
                                    else{
                                        $d = -1;
                                    }            
                                    $query1 = "select username from userprofile where uid =" .$info['emp_id'];
                                    $result1 = mysqli_query($con,$query1) or die(mysqli_error($con));
                                    $b = mysqli_fetch_assoc($result1);
                            ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $b['username']; ?></td>
                                    <td><?php if($info['leave_id']==1) echo "<p class = 'pl'> Personal Leave</p>";
                                              elseif($info['leave_id']==2) echo "<p class='cl'>Casual Leave</p>";
                                              else echo "<p class = 'sl'> Sick Leave</p>"; ?></td>
                                    <td><?php echo $info['days']; ?></td>
                                    <td>
                                    <?php
                                            
                                            if($d==1){
                                        ?>
                                        <button class="approve-btn" disabled>Approved</button>
                                        <?php
                                            }
                                            elseif ($d==0) {
                                        ?>
                                        <button class="reject-btn" disabled>Rejected</button>
                                        <?php 
                                            }
                                            else{ 
                                        ?>
                                        <button onclick="document.getElementById('myModal<?php echo $cnt ?>').style.display='block'" id="view">View</button>
                                        <?php
                                            }
                                        ?>
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
                                                            <input type="text" value="<?php echo $info['from_date']; ?>" disabled>
                                                        </div>
                                                        <div class="col">
                                                            <h3>To:</h3>
                                                            <input type="text" value="<?php echo $info['to_date']; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <h3 style="margin-top: 15px;">Leave Type</h3>
                                                    <div class="row">
                                                        <div class="col">
                                                        <?php if($info['leave_id']==1){?>
                                                            <input type="text" value="PL" disabled>
                                                        <?php } elseif($info['leave_id']==2){ ?>
                                                            <input type="text" value="CL" disabled>
                                                        <?php }else{?>
                                                            <input type="text" value="SL" disabled>
                                                        <?php }?>
                                                           
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="Info">
                                                        <h3>Total Days</h3>
                                                        <input type="text" value="<?php echo $info['days']?>">
                                                        <h3>Remarks</h3>
                                                        <textarea name="text" placeholder="Remarks" disabled></textarea>
                                                        <h3>Reason</h3>
                                                        <textarea name="text" placeholder="<?php echo $info['message']; ?>" disabled></textarea>
                                                    </div>
                                                    <form action="approveleave.php" id="forms" method="post">
                                                    <div class="col-md-12 text-center">
                                                    <a class="btn btn-primary" href="approveleave.php?id=<?php echo $info['id'];?>" >Approve</a>
                                                    <a class="btn btn-danger" href="rejectleave.php?id=<?php echo $info['id'];?>" >Reject</a>
                                                    
                                                    </div>
                                                    </form>
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
   
</body>
</html>
