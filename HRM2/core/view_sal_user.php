<?php
include_once('connect.php');
error_reporting(0);
session_start();
$session_id = $_SESSION['admin_id'];
if($_SESSION['admin_id']=='') {
    header("Location:login.php");
    exit;
}

//echo '<pre>'; print_R($_SESSION);exit;

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
                        <h5>View Salary</h5>
                    </div>
                    <div class="card-body">
                        <table id="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Credited to</th>
                                    <th>Month-Year</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- fetches query result into variable a  -->  
                            <?php 
                                $cnt=1;
                                
                                
                              //   stores the last row of database into variable named query
                                
                                $join = "select * from request_data where emp_id='$session_id'"; 
                                $joinresult = mysqli_query($con,$join) or die(mysqli_error($con));
                                while($info = mysqli_fetch_assoc($joinresult)){
                                        
                                    $query1 = "select * from userprofile where uid =" .$info['emp_id'];
                                    $result1 = mysqli_query($con,$query1) or die(mysqli_error($con));
                                    $b = mysqli_fetch_assoc($result1);
                            ?>
                                <tr>
                                    <td><?php echo $cnt ?></td>
                                    <td><?php echo $b['firstname'] ; ?> <?php echo $b['lastname'] ; ?></td>
                                    <td><?php echo $info['month'];?>-<?php echo $info['year'];?></td>
                                    <td><?php echo $info['amount']; ?></td>
                                    <td><a class="btn btn-sm btn-warning btnremove" href="pdf.php?id=<?php echo $info['id'];?>"><i class="fas fa-download"></i> </a></td>
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
