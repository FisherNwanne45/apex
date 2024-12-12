<?php
session_start();

if (isset($_POST['transfer'])) {
  // Check if entered OTP matches stored OTP
  if ($_SESSION['otp'] == $_POST['otp']) {
    // OTP is valid, perform desired action (e.g. redirect to another page)
    header("Location: suc.php");
  } else {
    echo "Invalid OTP. Please try again.";
  }
}
?>
<form action="" method="post">
  <label for="otp">OTP:</label>
  <input type="text" id="otp" name="otp">
  <input type="submit" name="verify" value="Verify">
</form>