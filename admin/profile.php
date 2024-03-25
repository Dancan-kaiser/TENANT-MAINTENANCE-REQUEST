<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0) {  
    header('location:index.php');
} else {
    if(isset($_POST['submit'])) {
        $fname=$_POST['fullname'];
        $contactno=$_POST['contactno'];
        $address=$_POST['address'];
        $state=$_POST['state'];
        $country=$_POST['country'];
        $pincode=$_POST['pincode'];
        $query=mysqli_query($bd, "UPDATE users SET fullName='$fname', contactNo='$contactno', address='$address', State='$state', country='$country', pincode='$pincode' WHERE id='".$_GET['uid']."'");
        if($query) {
            $successmsg="User details updated successfully!";
        } else {
            $errormsg="Failed to update user details.";
        }
    }

    $uid = $_GET['uid'];
    $user_query = mysqli_query($bd, "SELECT * FROM users WHERE id='$uid'");
    $user_row = mysqli_fetch_array($user_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Details</title>
    <!-- CSS links here -->
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
<?php include('include/header.php');?>

<div class="wrapper">
  <div class="container">
    <div class="row">
<?php include('include/sidebar.php');?>				
    <div class="span9">
        <div class="content">
        <div class="module">
    <div class="module-head">
        <h3>Manage Users</h3>
  
    <section id="main-content">
        <section class="wrapper">
           
                <div class="col-lg-12">
                    <div class="form-panel">
                      
                        <?php if(isset($successmsg)) { ?>
                        <div class="alert alert-success" role="alert"><?php echo $successmsg; ?></div>
                        <?php } ?>
                        <?php if(isset($errormsg)) { ?>
                        <div class="alert alert-danger" role="alert"><?php echo $errormsg; ?></div>
                        <?php } ?>
                        <h4 class="mb"><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo htmlentities($user_row['fullName']);?>'s Profile</h4>
                        
                        <form class="form-horizontal style-form" method="post" name="profile">
                            <div class="form-group">
                                <label class="col-sm-2 col-form-label">Full Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="fullname" required="required" value="<?php echo htmlentities($user_row['fullName']);?>" class="form-control">
                                </div>
                                <label class="col-sm-2 col-form-label">User Email</label>
                                <div class="col-sm-4">
                                    <input type="email" name="useremail" required="required" value="<?php echo htmlentities($user_row['userEmail']);?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-form-label">Contact (254)</label>
                                <div class="col-sm-4">
                                    <input type="text" name="contactno" required="required" value="<?php echo htmlentities($user_row['contactNo']);?>" class="form-control">
                                </div>
                                <label class="col-sm-2 col-form-label">Room Number</label>
                                <div class="col-sm-4">
                                    <textarea name="address" required="required" class="form-control"><?php echo htmlentities($user_row['address']);?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-form-label">Rental</label>
                                <div class="col-sm-4">
                                    <select name="state" required="required" class="form-control">
                                        <option value="<?php echo htmlentities($user_row['State']);?>"><?php echo htmlentities($st=$user_row['State']);?></option>
                                        <?php 
                                        $sql=mysqli_query($bd, "SELECT stateName FROM state ");
                                        while ($rw=mysqli_fetch_array($sql)) {
                                            if($rw['stateName']==$st) {
                                                continue;
                                            } else {
                                        ?>
                                        <option value="<?php echo htmlentities($rw['stateName']);?>"><?php echo htmlentities($rw['stateName']);?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-4">
                                    <input type="text" name="country" required="required" value="<?php echo htmlentities($user_row['country']);?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-form-label">ID Number</label>
                                <div class="col-sm-4">
                                    <input type="text" name="pincode" maxlength="8" required="required" value="<?php echo htmlentities($user_row['pincode']);?>" class="form-control">
                                </div>
                                <label class="col-sm-2 col-form-label">Reg Date</label>
                                <div class="col-sm-4">
                                    <input type="text" name="regdate" required="required" value="<?php echo htmlentities($user_row['regDate']);?>" class="form-control" readonly>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <div class="col-sm-10" style="padding-left:30%">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            
        </section>
    </section>
</div>

  
    </div>
    </section>
    <?php include("include/footer.php");?>

    
</body>
</html>

