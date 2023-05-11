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
    <script src="../assets/js/designation.js"></script><script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.js"></script>
    
    </head>
    <script type="text/javascript">
        $(document).ready(function() {
        $("#holidayform").validate({
    rules: {
    holiday_name : {
    required: true,
    },
    date : {
    required: true,
    },
    },
    messages : {
    holiday_name: {
    required: "<p style='color:red;font-weight:100; font-size:14px'>Enter name to continue!</p>"
    },
    date: {
    required: "<p style='color:red;font-weight:100; font-size:14px'>Enter Designation name to continue!</p>"
    }
}
    });
    });
    
    </script>

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
                        <h5>Holiday</h5>
                    </div>
                    <form action="../core/holiday_connect.php" method="POST" id="holidayform">
                        <p style="margin-left: 1rem;">Holiday Name: <input type="text" name="holiday_name" placeholder="Enter new Holiday" style="margin-bottom: 1rem;"><br>Date :<input type="date"  name="date" placeholder="dd/mm/yyyy" style="margin-bottom: 1rem;margin-left: 4.93rem;"><br><input type="submit" name="save" class="btn btn-info" value="Save"></p>
                        
                    </form>
                   
                    <div class="card-body">
                        <table id="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Date</th>
                                    <th style=>Holiday Name</th>
                                    <th class="ac">Action</th>
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
                                    <td><a class="btn btn-sm btn-danger btnremove" href="delete_holiday.php?id=<?php echo $info['id'];?>" onclick="return confirm('Are you sure to delete thsis record?');"><i class="fas fa-trash"></i> </a></td>
                                    
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

