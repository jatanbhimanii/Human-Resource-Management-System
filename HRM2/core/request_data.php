<?php
include('connect.php');
session_start();
$session_id = $_SESSION['admin_id'];
if($_SESSION['admin_id']=='') {
    header("Location:login.php");
    exit;
}

// connection is set 

if(isset($_POST['submit'])){
    $emp_id = $_POST['emp_id']; 
    $month = $_POST['month'];
    $year = $_POST['year'];
    $amount = $_POST['amount'];
    $query = "INSERT into request_data (emp_id,month,year,amount) values ('$emp_id','$month','$year','$amount')";
    $query_run = mysqli_query($con,$query);
    if($query_run){
        echo '<script>window.location.href="../core/view_sal.php"</script>';
        echo '<script>alert("Salary Credited!")</script>';
    }
    else{
        echo '<script>alert("Salary not Credited!")</script>';
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
    <link rel="stylesheet" href="../assets/css/viewleaverequest.css">
    <link rel="stylesheet" href="../assets/css/request_data.css">
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.js"></script>

    <script type="text/javascript">
    
    (function($, W, D)
    {
        var JQUERY4U = {};

        JQUERY4U.UTIL =
                {
                    setupFormValidation: function()
                    {
                        //form validation rules
                        $("#salform").validate({
                            rules: {
                                emp_id: "required",
                                month: "required",
                                year: "required",
                                amount: "required",
                            },
                            messages: {
                                emp_id: "<p style='color:red;font-weight:100; font-size:14px'>Please Enter Username!</p>",
                                month:  "<p style='color:red;font-weight:100; font-size:14px'>Please Enter Password!</p>",
                                year:  "<p style='color:red;font-weight:100; font-size:14px'>Please Enter Password!</p>",
                                amount:  "<p style='color:red;font-weight:100; font-size:14px'>Please Enter Password!</p>",
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
</head>

<body>
    <div class="container-fluid">
        <div class="row">
        <!-- contains code for side navigation bar  --> 
        <?php include '../core/admin_sidenav.php';?>
		<?php include('functions.php');?>
        <script src="../assets/js/sidenav.js"></script>
            <div class="col-9">
                <!-- card starts  -->
                    <div class="card">
                    <div class="card-title">
                        <p class="nav">Add Salary</p>
                    </div>
                    <form method="POST" id="salform">
                    <div class="card-body">
                        <div class="class1">
                            <div class="row">
                                <div class="col">
                                    <p>Employee Name</p>
									<?php $emp_names  = get_employee_name();?>
                                    <select name="emp_id" class="form-control" onchange="get_user_details(this.value);">
									<option value="" hidden>Select Employee</option>
								<?php foreach($emp_names as $emp) { ?>
									<option value="<?php echo $emp['uid'];?>"><?php echo $emp['username'];?></option>
									<?php } ?>
									</select>
                                </div>
                            </div>
                        </div>
                        <div class="class2">
                            <div class="row">
                                <div class="col">
                                    <p>Month</p>
                                    <select name="month" id="month">
                                        <option value="" hidden>Select Month</option>
                                        <option value="Jan">Jan</option>
                                        <option value="Feb">Feb</option>
                                        <option value="Mar">Mar</option>
                                        <option value="Apr">Apr</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="Jul">Jul</option>
                                        <option value="Aug">Aug</option>
                                        <option value="Sep">Sep</option>
                                        <option value="Oct">Oct</option>
                                        <option value="Nov">Nov</option>
                                        <option value="Dec">Dec</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <p>Year</p>
                                    <select type="number" name="year" id="year" placeholder="Year">
                                        <option value="" hidden>Select Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="class3">
                            <div class="row">
                                <div class="col">
                                    <p>Bank Name</p>
                                    <input type="text" id="bank_name" name="bank_name" disabled>
                                </div>
                                <div class="col">
                                    <p>IFSC Code</p>
                                    <input type="text" name="ifsc" id="ifsc" disabled>
                                </div>
                                <div class="col">
                                    <p>Designation</p>
                                    <input type="text" name="designation" id="designation" disabled>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col">
                                    <p>Account Number</p>
                                    <input type="number" name="account_number" id="account_number" disabled>
                                </div>
                                <div class="col">
                                    <p>Amount</p>
                                    <input type="number" name="amount" id="amount" >
                                </div>
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
</body>

</html>

<!-- php code starts  -->

<!-- php code ends  -->
<script>
function get_user_details(v) {
if(v=='0') {
	alert('Please select Employee');
	return false;
}    
$.ajax(
  'first.php',
  {
    url: 'first.php',
    type: 'post',
    data: { "emp_id": v},
    success: function(res) {                        
		json_obj2 = $.parseJSON(res);
		
		$('#bank_name').val(json_obj2.bank);
		$('#ifsc').val(json_obj2.ifsc);
		$('#designation').val(json_obj2.designation);
		$('#account_number').val(json_obj2.account_number);
      },
      error: function() {
        alert('There was some error performing the AJAX call!');
      }
   }
   
);

}
window.onload = function () {
        //Reference the DropDownList.
        var yr = document.getElementById("year");
 
        //Determine the Current Year.
        var currentYear = (new Date()).getFullYear();
 
        //Loop and add the Year values to DropDownList.
        for (var i = currentYear-1; i <= currentYear; i++) {
            var option = document.createElement("OPTION");
            option.innerHTML = i;
            option.value = i;
            yr.appendChild(option);
        }
    };

</script>