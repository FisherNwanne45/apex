<?php  //Start the Session

session_start();

 require('connectdb.php');
 require_once 'class.user.php';
 
 $reg_user = new USER();
 

//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['acc_no']) and isset($_POST['upass'])){
//3.1.1 Assigning posted values to variables.

$acc_no = $_POST['acc_no'];
$upass = $_POST['upass'];
$upass = md5($upass);
$code = mt_rand(1000,9999);
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM account WHERE acc_no='$acc_no' and upass='$upass'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);


$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$acc_no'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$log = $reg_user->runQuery("UPDATE account SET logins = logins + 1 WHERE '$acc_no'");
$log->execute();


$status = $row['status'];
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 0){
	$msg = "<div class='alert alert-danger'>
						<button class='close' data-dismiss='alert'>&times;</button>
						  Invalid Account No or Password!
                   
			  </div>";
}
elseif($status == 'Disabled'){
	$msg = "<div class='alert alert-inverse'>
						<button class='close' data-dismiss='alert'>&times;</button>
						  <strong>Sorry! Your Account Has Been Disabled For Violation of Our Terms!</strong>
                   
			  </div>";
}
elseif($status == 'Closed'){
	$msg = "<div class='alert alert-inverse'>
						<button class='close' data-dismiss='alert'>&times;</button>
						  <strong>Sorry! That Account No Longer Exist!</strong>
                   
			  </div>";
}
else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
$_SESSION['acc_no'] = $acc_no;
$_SESSION['mname'] = $acc_no;
   // Redirect user to index.php
	    header("Location: index.php");
}
}
?>
<?php

        include('config.php');
        $result = $conn->query("SELECT * FROM site");
        if(!$result->num_rows > 0){ echo '<h2 style="text-align:center;">No Data Found</h2>'; }
        while($rowp = $result->fetch_assoc())
        {
      ?>
<script>
document.onkeydown = function(e) {
    if (event.keyCode == 123) {
        return false;
    }
    if (e.ctrlKey && e.shiftKey && (e.keyCode == 'I'.charCodeAt(0) || e.keyCode == 'i'.charCodeAt(0))) {
        return false;
    }
    if (e.ctrlKey && e.shiftKey && (e.keyCode == 'C'.charCodeAt(0) || e.keyCode == 'c'.charCodeAt(0))) {
        return false;
    }
    if (e.ctrlKey && e.shiftKey && (e.keyCode == 'J'.charCodeAt(0) || e.keyCode == 'j'.charCodeAt(0))) {
        return false;
    }
    if (e.ctrlKey && (e.keyCode == 'U'.charCodeAt(0) || e.keyCode == 'u'.charCodeAt(0))) {
        return false;
    }
    if (e.ctrlKey && (e.keyCode == 'S'.charCodeAt(0) || e.keyCode == 's'.charCodeAt(0))) {
        return false;
    }
}
</script>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png?x26336">
        <title><?php echo $rowp['name']; ?> | Login Page</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Custom CSS -->
        <style>
        body {
            background-image: url("img/hero-1.jpg");
            background-size: 100%;
            background-repeat: repeat;
            background-attachment: fixed;
            background-position: center center;
            margin: 0;
            padding: 0;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .login-box {
            width: 60%;
            height: 250px;
            background-color: #0069aa;
            border-radius: 20px;
            padding: 1rem;
            display: flex;
            align-items: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        .login-form {
            width: 400px;
            height: 400px;
            background-color: #fff;
            padding: 2rem;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        .login-form h3 {
            text-align: center;
        }

        .login-form small {
            display: block;
            text-align: center;
        }

        .mr-4 {
            color: white;
        }

        /* Media query for smaller screens */
        @media (max-width: 768px) {
            .login-box {
                width: 80%;
                height: auto;
                margin: 2rem 0;
                flex-direction: column;
                justify-content: center;
            }

            .login-form {
                width: 80%;
                max-width: 350px;
                height: auto;
                margin: 1rem auto;
            }

            .mr-4 {
                display: none;
            }
        }
        </style>
    </head>

    <body>


        <!-- Header with logo -->
        <div class="login-container">
            <div class="login-box">
                <!-- Dummy text on the left side -->
                <div class="mr-4">
                    <h6>Welcome to </h6>
                    <h5><?php echo $rowp['name']; ?></h5>
                    <p>Manage your account on the go!<br> Get instant access to your recent transactions,<br> latest and
                        previous statements, as well as <br>enrollment in eStatement Via Email </p>
                </div>
                <!-- Login form on the right side -->
                <div class="login-form">
                    <div class="text-center">
                        <img src="img/logo.png" alt="<?php echo $rowp['name']; ?>" width="150">
                    </div><br>
                    <form name="form1" method="POST" autocomplete="off">
                        <h6>Login to Account</h6>
                        <h6> <?php 
				if(isset($_GET['inactive']))
				{
					?>
                            <div class='alert alert-info col-4'>
                                <br><button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it.
                            </div>
                            <?php
				}
			?>
                            <?php if(isset($msg)) echo $msg;  ?>
                        </h6>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="acc_no" id="acc_no"
                                placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="upass" id="upass"
                                placeholder="Enter password" required>
                        </div> <input type="hidden" name="code" value="<?php echo $code; ?>" class="form-control" />
                        <button type="submit" class="btn btn-primary btn-block" style="
  background-color: #0069aa;
  color: #fff;
  padding: 10px 20px;
  border: 1px solid #0069aa;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
  /* Hover style */
  &:hover {
    background-color: #da4c00;
  }
">Login</button>

                        <br>
                        <small><a href="admin/eForm.php">Register Now</a> | <a href="#">Forgot Password</a></small>
                    </form>
                </div>
            </div>
        </div>


        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <?php echo $rowp['tawk']; ?>
        <!--End of Tawk.to Script-->
        <?php } ?>
    </body>

</html>