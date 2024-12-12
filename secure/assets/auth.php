<?php 
require_once('functions.php');

if ($_GET['action'] == "verifyRecaptcha"){
if(isset($_POST)){
    if($_GET['code'] == $_POST['captcha']){
     feedback("toast", "success", "Verification Successful", "Verified");
     borderError("green", "captcha");
     $_SESSION['accessBanking'] = randomString(64);
     print redirect(1, "login.php");
    }
    else{
      feedback("toast", "error", "Invalid code supplied", "Error");  
      borderError("red", "captcha");
    }
} 
}
?>