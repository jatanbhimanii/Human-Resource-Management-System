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
   //   stores the last row of database into variable named query
      
    
    if (isset($_POST['resubmit'])) {
        $resubmit = $_POST['resubmit'];
        $query1 = "INSERT INTO requeststatus(rejected_id) VALUES ('$resubmit')";
        $query_run1 = mysqli_query($con,$query1);
        if($query_run1)
        { 
            echo '<script>alert("Leave Rejected Successfully!")</script>';
        }
        else {
            echo '<script>alert("Action Not Taken!")</script>';
        }
    }

    elseif (isset($_POST['apsubmit'])) {
    $apsubmit = $_POST['apsubmit'];
    $query = "INSERT INTO requeststatus(approved_id) VALUES ('$apsubmit')";
    $query_run = mysqli_query($con,$query);
    if($query_run)
    { 
        echo '<script>alert("Leave Approved Successfully!")</script>';
    }
    else {
        echo '<script>alert("Action Not Taken!")</script>';
    }
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
            <?php include '../core/sidenav.php';?>
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
                                
                                $join = "select * from requestforleave left join requeststatus on requestforleave.id = requeststatus.approved_id or requestforleave.id = requeststatus.rejected_id where emp_id = '$session_id'";
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
                                                    <h3 style="margin-top: 15px;">Leave Counter</h3>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h3>PL</h3>
                                                            <input type="text" value="<?php if($info['leave_id']==1) echo $info['days'];
                                                            elseif($info['leave_id']==2) echo "0";
                                                            else echo "0"; ?>" disabled>
                                                        </div>
                                                        <div class="col">
                                                            <h3>CL</h3>
                                                            <input type="text" value="<?php if($info['leave_id']==2) echo $info['days'];
                                                            elseif($info['leave_id']==1) echo "0";
                                                            else echo "0"; ?>" disabled>
                                                        </div>
                                                        <div class="col">
                                                            <h3>SL</h3>
                                                            <input type="text" value="<?php if($info['leave_id']==3) echo $info['days'];
                                                            elseif($info['leave_id']==1) echo "0";
                                                            else echo "0"; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="Info">
                                                        <h3>Total</h3>
                                                        <input type="text" value="<?php echo $info['days']?>">
                                                        <h3>Remarks</h3>
                                                        <textarea name="text" placeholder="Remarks" disabled></textarea>
                                                        <h3>Reason</h3>
                                                        <textarea name="text" placeholder="<?php echo $info['message']; ?>" disabled></textarea>
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
