<?php
    include('connect.php');
    error_reporting(0);
    session_start();
    $session_id = $_SESSION['admin_id'];
    if($_SESSION['admin_id']=='') {
        header("Location:login.php");
        exit;
    }
    
    $query = "select sum(pl+cl+sl) as sum from master_leave where emp_id = '$session_id'";
    $result = mysqli_query($con, $query) or die( mysqli_error($con));
    $a = mysqli_fetch_assoc($result) or die( mysqli_error($con));
 
    if (isset($_POST['submit'])) {
    // defining variables
    $from_date = $_POST['from_date'];   
    $to_date = $_POST['to_date'];   
    $leave_id = $_POST['leave_id'];
    $days = $_POST['days'];
    $message = $_POST['message'];
    $emp_id = $session_id;
    
    
    // inserting data 
    $query = "INSERT INTO requestforleave(emp_id,from_date,to_date,leave_id,days,message) VALUES ('$emp_id','$from_date','$to_date','$leave_id','$days','$message')";
   
    $query_run = mysqli_query($con,$query) or die( mysqli_error($con));


    if($query_run)
    { 
        header("Location: ../core/viewleaverequest_user.php");
        echo '<script>alert("Request placed successfully!")</script>';
    }
    else {
        echo '<script>alert("Request failed!")</script>';
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
    <!-- contains all css files  -->
    <link rel="stylesheet" href="../assets/css/RequestForLeave.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
        <!-- contains code for side navigation bar  --> 
        <?php include '../core/sidenav.php';?>
        <script src="../assets/js/sidenav.js"></script>
            <div class="col-9">
                <!-- contains code for logout button  -->
                
                
                <!-- card starts  -->
                <div class="card">
                    <div class="card-title">
                        <p class="nav">Request For Leave</p>
            
                    </div>
                    <form method="POST" id="requestform">
                    <div class="card-body">
                        <div class="class1">
                            <div class="row">
                                <div class="col">
                                    <p>From</p>
                                    <input type="date" name="from_date" placeholder="mm/dd/yyyy">
                                </div>
                                <div class="col">
                                    <p>To</p>
                                    <input type="date" name="to_date" placeholder="mm/dd/yyyy"> 
                                </div>
                            </div>
                        </div>
                        <div class="class2">
                                <div class="row">
                                    <div class="col">
                                    <p>Leave Counter</p>
                                            <select name="leave_id" id="leave_id">
                                                <option value="" hidden>Select Leave Type</option>
                                                <option value="1">PL</option>
                                                <option value="2">CL</option>
                                                <option value="3">SL</option>
                                            </select>
                                    </div>
                                    <div class="col">
                                    <p>No. Of Days</p>
                                    <input type="number" name="days" id="days" placeholder="No. Of Days">
                                    </div>
                                    
                                </div>
                        </div>
                        <div class="class3">
                            <div class="row">
                                <div class="col">
                                    <p>Total Leave Taken</p>
                                    <?php if($a['sum']==''){ ?>
                                    <input type="number" name="total_leave" value="0" disabled>
                                    <?php }else{?>
                                    <input type="number" name="total_leave" value="<?php echo $a['sum']; ?>" disabled>
                                    <?php }?>
                                </div>
                                <div class="col">
                                    <p>Remain Leave</p>
                                    <input type="text" name="text" value="<?php echo 24-$a['sum']; ?>" disabled>
                                </div>
                            </div>
                            <div class="message">
                                <p>Message</p>
                                <textarea name="message" placeholder="Message" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="class4">
                            <div class="row">
                                <div class="col">
                                    <div class="button1">
                                    <input type="submit" value="Apply" class="submit" name="submit">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="button2">
                                    <a href="#">
                                        <button>Reset</button></a>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="button3">
                                    <a href="#">
                                        <button>Cancel</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <!-- card ends  -->
                
            </div>
        </div>
    </div>
    <?php include '../core/footer.php';?>
<script type="text/javascript">
    
    (function($, W, D)
    {
        var JQUERY4U = {};

        JQUERY4U.UTIL =
                {
                    setupFormValidation: function()
                    {
                        //form validation rules
                        $("#requestform").validate({
                            rules: {
                                from_date: "required",
                                to_date: "required",
                                leave_id: "required",
                                days: "required",
                                message: "required",
                            },
                            messages: {
                                from_date: "<p style='color:red;font-weight:100; font-size:14px'>Please enter this field!</p>",
                                to_date:  "<p style='color:red;font-weight:100; font-size:14px'>Please enter this field!</p>",
                                leave_id:  "<p style='color:red;font-weight:100; font-size:14px'>Please enter this field!</p>",
                                days:  "<p style='color:red;font-weight:100; font-size:14px'>Please enter this field!</p>",
                                message:  "<p style='color:red;font-weight:100; font-size:14px'>Please enter this field!</p>",
								},
                            submitHandler: function(form) {
                                form.submit();
                            }
                        });
                    }
                }

        //when the dom has loaded setup form validation rules
        $(D).ready(function($) {
            JQUERY4U.UTIL.setupFormValidation();
        });

    })(jQuery, window, document);
</script>
</body>

</html>

<!-- php code starts  -->
<?php
// connection is set 

?>
<!-- php code ends  -->