<?php
include('connect.php');
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
    <link rel="stylesheet" href="../assets/css/designation.css">
    <script src="../assets/js/designation.js"></script>
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
                        <h5>Holiday</h5>
                    </div>
                    
                    <div class="card-body">
                        <table id="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Date</th>
                                    <th style=>Holiday Name</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <!-- fetches query result into variable a  -->  
                                <?php 
                                
                                $cnt=1;
                                $join = "select * from holiday";
                                $joinresult = mysqli_query($con,$join) or die(mysqli_error($con));
                                
                                while($info = mysqli_fetch_assoc($joinresult)){
                                      
                                 ?>

                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $info['date']; ?></td>
                                    <td><?php echo $info['holiday_name']; ?></td>
                                    
                                    
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

