<?php 
include('connect.php');
session_start();
if($_SESSION['admin_id']=='') {
	header("Location:login.php");
	exit;
}
//echo '<pre>'; print_R($_SESSION);exit;
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!-- embedes php code from connect.php  -->
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
    <link rel="stylesheet" href="../assets/css/list_employee.css">
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
                        <h5>Employee List</h5>
                    </div>
                    <div class="card-body">
                        <table id="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Employee Name</th>
                                    <th>Status</th>
                                    <th>Designation</th>
                                    <th>Join Date</th>
                                    
                                    <th class="ac">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- fetches query result into variable a  -->  
                            <?php 
                                $cnt=1;
                                $join = "select * from userprofile";
                                $joinresult = mysqli_query($con,$join) or die(mysqli_error($con));
                                while($info = mysqli_fetch_assoc($joinresult)){
                            ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $info['firstname']?> <?php echo $info['m_name']?> <?php echo $info['lastname']?> [<?php echo $info['uid']?>]</td>
                                    <td><?php echo $info['status']?></td>
                                    <td><?php echo $info['designation']?></td>
                                    <td><?php echo $info['join_date']?></td>
                                    <td>
                                    <a href="../core/update_employee.php">
                                        <button class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></button>
                                    </a>
                                    <a class="btn btn-sm btn-danger btnremove" href="delete_employee.php?uid=<?php echo $info['uid'];?>" onclick="return confirm('Are you sure to delete thsis record?');"><i class="fas fa-trash"></i> </a>
                                    <a href="../core/request_data.php">
                                    <button class="btn btn-sm btn-warning"><i class="fas fa-coins"></i> </button>
                                    </a>
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
<?php
include('connect.php');

if(isset($_POST['remove'])){
    $id = $_POST[$info['uid']];
    echo $id;
    exit('aa');
}

?>
