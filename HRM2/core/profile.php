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
  $session_user = $_SESSION['user'];

//   stores the last row of database into variable named query
    $query = "select * from userprofile where uid = '$session_id'";
    $result = mysqli_query($con, $query) or die( mysqli_error($con));
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>EightTech - HRM</title>
    <!-- contains all header links -->
    <?php include '../core/header.php';?>
    <!-- contains all css and js files  -->
    <link rel="stylesheet" href="../assets/css/profile.css">
    <script src="../assets/js/leaverequest.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- contains code for side navigation bar  -->
            <?php include '../core/sidenav.php';?>
            <script src="../assets/js/sidenav.js"></script>
              
                <?php
                    if (isset($_SESSION['status'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Login Sucessfully!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                        echo $_SESSION['status'];
                        unset($_SESSION['status']); 
                    }
                ?>
                <!-- fetches query result into variable a  -->
                <?php 
                    $a = mysqli_fetch_assoc($result);
                ?>
                <!-- landing page starts  -->
                <div class="container">
                    <div class="row mx-auto">
                        <!-- first card starts -->
                        <div class="col-3">
                            <div class="card c1">
                                <div class="card-head">
                                <?php $lower = strtolower($a['firstname']); ?>
                                    <img src="../assets/uploadimage/<?=$session_user?>/<?=$a['profile_img']?>" onerror="this.src='../assets/images/dummy.png'" class="profile-img img-fluid">
                                    <h4 class="username"><?php echo $a['username']; ?></h4>
                                    <p class="email"><?php echo $lower; ?>@eighttechproject.com</p>
                                </div>
                                <a href="../core/userprofile.php" class="go-to-profile"><i class="fa fa-edit"></i>Go to Profile</a>
                            </div>
                        </div>
                        <!-- first card ends  -->

                        <!-- second card starts  -->
                        <div class="col-9">
                            <div class="card c2">
                                <h1 class="basic-detail-head">Basic Details</h1>
                                <div class="name-detail">
                                    <p class="text-name"><i class="fa fa-2x fa-user"></i>Name <br><?php echo $a['firstname']; ?>&nbsp;<?php echo $a['lastname']; ?></p>
                                </div>
                                <div class="address-detail">
                                    <p class="text-address"><i class="fa fa-2x fa-location-arrow"></i>Address <br> <?php echo $a['curaddress']; ?></p>
                                </div>
                                <div class="row">
                                    <div class="col-6 dob">
                                        <?php if($a['dateofbirth']=="0000-00-00"){?>
                                        <p class="text-dob"><i class="fa fa-2x fa-calendar"></i>Date Of Birth <br></p>
                                        <?php } else{?>
                                        <p class="text-dob"><i class="fa fa-2x fa-calendar"></i>Date Of Birth <br> <?php echo $a['dateofbirth']; ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6 designation">
                                        <p class="text-designation"><i class="fa fa-2x fa-code-fork"></i>Designation <br> <?php echo $a['designation']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mail">
                                        
                                        <p class="text-mail"><i class="fa fa-2x fa-envelope"></i>Email <br> <?php echo $lower; ?>@gmail.com</p>
                                    </div>
                                    <div class="col-6 phone">
                                    <?php if($a['dateofbirth']=="0000-00-00"){?>
                                        <p class="text-phone"><i class="fa fa-2x fa-mobile"></i>Phone <br></p>
                                        <?php } else{?>
                                            <p class="text-phone"><i class="fa fa-2x fa-mobile"></i>Phone <br> (+91) <?php echo $a['contact']; ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- second card ends -->
                    </div>
                </div>
                <?php 
                ?>
            </div>
        </div>
    </div>
    <?php include '../core/footer.php';?>
</body>
</html>