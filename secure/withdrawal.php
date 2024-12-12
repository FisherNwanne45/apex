<?php
session_start();
include_once ('session.php');
require_once 'class.user.php';
if(!isset($_SESSION['acc_no'])){
	
header("Location: login.php");
exit(); 
}

elseif(!isset($_SESSION['mname'])){
    
header("Location: passcode.php");
exit(); 
}
$reg_user = new USER();

$site = $row['site'];

$stct = $reg_user->runQuery("SELECT * FROM site WHERE id = '20'");
$stct->execute(array(":acc_no"=>$_SESSION['acc_no']));
$rowp = $stct->fetch(PDO::FETCH_ASSOC);

$mail = $rowp['email'];
$url = $rowp['url'];
$name = $rowp['name'];
$addr = $rowp['addr'];
$sc = $rowp['sc'];


$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$stat = $row['status'];
if($stat == 'Dormant/Inactive'){
	header('Location: index.php?dormant#dormant');
	exit();
}
if($stat == 'pincode'){
	header('Location: make_transfer2.php');
	exit();
}
if($stat == 'otp'){
	header('Location: otp.php');
	exit();
}
if(isset($_POST['transfer'])){
	$email = $row['email'];
	
	$amount = trim($_POST['amount']);
	$amount = strip_tags($amount);
	$amount = htmlspecialchars($amount);
	
	$acc_no = trim($_POST['acc_no']);
	$acc_no = strip_tags($acc_no);
	$acc_no = htmlspecialchars($acc_no);
	
	$acc_name = trim($_POST['acc_name']);
	$acc_name = strip_tags($acc_name);
	$acc_name = htmlspecialchars($acc_name);
	
	$bank_name = trim($_POST['bank_name']);
	$bank_name = strip_tags($bank_name);
	$bank_name = htmlspecialchars($bank_name);
	
	$swift = trim($_POST['swift']);
	$swift = strip_tags($swift);
	$swift = htmlspecialchars($swift);
	
	$routing = trim($_POST['routing']);
	$routing = strip_tags($routing);
	$routing = htmlspecialchars($routing);
		
	$type = trim($_POST['type']);
	$type = strip_tags($type);
	$type = htmlspecialchars($type);
	
	$remarks = trim($_POST['remarks']);
	$remarks = strip_tags($remarks);
	$remarks = htmlspecialchars($remarks);
	
	if($reg_user->temp($email,$amount,$acc_no,$acc_name,$bank_name,$swift,$routing,$type,$remarks)){
	
	header("Location: auth.php");
	}
	
}
	
include_once ('counter.php');
?>

<!DOCTYPE html>
 
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>  <?php echo $rowp['name']; ?>  | Dashboard     - Credit Cards, Banking, Loans and Mobile Payments</title>
      <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="assetfiles/dom_files/materialdesignicons.min.css">
    <link rel="stylesheet" href="assetfiles/dom_files/vendor.bundle.base.css">
    <link rel="stylesheet" href="assetfiles/dom_files/font-awesome.min.css">
    <link rel="stylesheet" href="assetfiles/dom_files/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assetfiles/dom_files/style.css">
     <link href="img/favicon.png" rel="icon" type="image/png">
     
     <script src="assetfiles/dom_files/a076d05399.js.download" crossorigin="anonymous"></script>
     
<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 80px;
  height: 80px;
  margin: -76px 0 0 -76px;
  border: 10px solid #d45706;
  border-radius: 50%;
  border-top: 10px solid black;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
</style>



<style>


.cardcc{
width: 300px;
height: 190px;
  -webkit-perspective: 28%;
  -moz-perspective: 250px;
  perspective:300px;
  
}

.cardcc__part{
  box-shadow: 1px 1px #aaa3a3;
    top: 0;
  position: absolute;
z-index: 1000;
  left: 0;
  display: inline-block;
    width: 300px;
    height: 190px;c background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    background-color: #0c8a80;
    border-radius: 8px;
   
    -webkit-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -moz-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -ms-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -o-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -webkit-transform-style: preserve-3d;
    -moz-transform-style: preserve-3d;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
}

.cardcc__front{
  padding: 18px;
-webkit-transform: rotateY(0);
-moz-transform: rotateY(0);
}

.cardcc__back {
  padding: 18px 0;
-webkit-transform: rotateY(-180deg);
-moz-transform: rotateY(-180deg);
}

.cardcc__black-line {
    margin-top: 5px;
    height: 38px;
    background-color: #303030;
}

.cardcc__logo {
    height: 16px;
}

.cardcc__front-logo{
      position: absolute;
    top: 18px;
    right: 18px;
}
.cardcc__square {
    border-radius: 5px;
    height: 30px;
}

.cardcc_numer {
    display: block;
    width: 100%;
    word-spacing: 4px;
    font-size: 20px;
    letter-spacing: 2px;
    color: #fff;
    text-align: center;
    margin-bottom: 20px;
    margin-top: 20px;
}

.cardcc__space-75 {
    width: 75%;
    float: left;
}

.cardcc__space-25 {
    width: 25%;
    float: left;
}

.cardcc__label {
    font-size: 10px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.8);
    letter-spacing: 1px;
}

.cardcc__info {
    margin-bottom: 0;
    margin-top: 5px;
    font-size: 16px;
    line-height: 18px;
    color: #fff;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.cardcc__back-content {
    padding: 15px 15px 0;
}
.cardcc__secret--last {
    color: #303030;
    text-align: right;
    margin: 0;
    font-size: 14px;
}

.cardcc__secret {
    padding: 5px 12px;
    background-color: #fff;
    position:relative;
}

.cardcc__secret:before{
  content:'';
  position: absolute;
top: -3px;
left: -3px;
height: calc(100% + 6px);
width: calc(100% - 42px);
border-radius: 4px;
  background: repeating-linear-gradient(45deg, #ededed, #ededed 5px, #f9f9f9 5px, #f9f9f9 10px);
}

.cardcc__back-logo {
    position: absolute;
    bottom: 15px;
    right: 15px;
}

.cardcc__back-square {
    position: absolute;
    bottom: 15px;
    left: 15px;
}

.cardcc:hover .cardcc__front {
    -webkit-transform: rotateY(180deg);
    -moz-transform: rotateY(180deg);

}

.cardcc:hover .cardcc__back {
    -webkit-transform: rotateY(0deg);
    -moz-transform: rotateY(0deg);
}
</style>
 






<style>
 

.cardcc1{
width: 320px;
height: 190px;
  -webkit-perspective: 98%;
  -moz-perspective: 600px;
  perspective:600px;
  
}

.cardcc1__part{
  box-shadow: 1px 1px #aaa3a3;
    top: 0;
  position: absolute;
z-index: 1000;
  left: 0;
  display: inline-block;
    width: 320px;
    height: 190px;c background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    background-color: #044717;
    border-radius: 8px;
   
    -webkit-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -moz-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -ms-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -o-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -webkit-transform-style: preserve-3d;
    -moz-transform-style: preserve-3d;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
}

.cardcc1__front{
  padding: 18px;
-webkit-transform: rotateY(0);
-moz-transform: rotateY(0);
}

.cardcc1__back {
  padding: 18px 0;
-webkit-transform: rotateY(-180deg);
-moz-transform: rotateY(-180deg);
}

.cardcc1__black-line {
    margin-top: 5px;
    height: 38px;
    background-color: #303030;
}

.cardcc1__logo {
    height: 16px;
}

.cardcc1__front-logo{
      position: absolute;
    top: 18px;
    right: 18px;
}
.cardcc1__square {
    border-radius: 5px;
    height: 30px;
}

.cardcc1_numer {
    display: block;
    width: 100%;
    word-spacing: 4px;
    font-size: 20px;
    letter-spacing: 2px;
    color: #fff;
    text-align: center;
    margin-bottom: 20px;
    margin-top: 20px;
}

.cardcc1__space-75 {
    width: 75%;
    float: left;
}

.cardcc1__space-25 {
    width: 25%;
    float: left;
}

.cardcc1__label {
    font-size: 10px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.8);
    letter-spacing: 1px;
}

.cardcc1__info {
    margin-bottom: 0;
    margin-top: 5px;
    font-size: 16px;
    line-height: 18px;
    color: #fff;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.cardcc1__back-content {
    padding: 15px 15px 0;
}
.cardcc1__secret--last {
    color: #303030;
    text-align: right;
    margin: 0;
    font-size: 14px;
}

.cardcc1__secret {
    padding: 5px 12px;
    background-color: #fff;
    position:relative;
}

.cardcc1__secret:before{
  content:'';
  position: absolute;
top: -3px;
left: -3px;
height: calc(100% + 6px);
width: calc(100% - 42px);
border-radius: 4px;
  background: repeating-linear-gradient(45deg, #ededed, #ededed 5px, #f9f9f9 5px, #f9f9f9 10px);
}

.cardcc1__back-logo {
    position: absolute;
    bottom: 15px;
    right: 15px;
}

.cardcc1__back-square {
    position: absolute;
    bottom: 15px;
    left: 15px;
}

.cardcc1:hover .cardcc1__front {
    -webkit-transform: rotateY(180deg);
    -moz-transform: rotateY(180deg);

}

.cardcc1:hover .cardcc1__back {
    -webkit-transform: rotateY(0deg);
    -moz-transform: rotateY(0deg);
}
</style>
 



  </head>
  <body > 
 <!---begin of Mobile View Here   only from <?php echo $row['fname']; ?> <?php echo $row['lname']; ?>-->
 
       <div class="container-scroller">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="text-center sidebar-brand-wrapper d-flex align-items-center" style="background-color:#fff; color:black;">
          <a class="sidebar-brand brand-logo" href="#"><img src="img/logo.png"></a>
          <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="#"><img src="img/logo.png"></a>
        </div>
        <ul class="nav" style="background-color:#fff; color:black;">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="admin/foto/<?php echo $row['pp']; ?>" alt="profile">
                <span class="login-status online"></span>
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex flex-column pr-3">
                <span class="font-weight-medium mb-2"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></span>
                <span class="font-weight-normal"> <?php echo $row['currency']; ?><?php echo number_format ($row['t_bal'],2); ?></span> 
              </div>
              
            </a>
          </li>
          <li class="nav-item "><h5 style="color:black; font-size:14px; padding-top:10px;"> Account Status:   <?php
 
   
$stat = $row['status'];

if($stat == "Active" || $stat == "pincode" || $stat == "otp")
{
echo '  Active   ';
} elseif($stat == "Dormant/Inactive") {    echo '  Inactive   ';
               
        }
else {    echo $row['status'];
               
        }
?> </h5></li><li class="nav-item "><div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 
'ar,en,es,jv,ko,pa,pt,ru,zh-CN,zh-TW,ja', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
} </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<style type="text/css">
        /* OVERRIDE GOOGLE TRANSLATE WIDGET CSS BEGIN */
      

        div#google_translate_element div.goog-te-gadget-simple a.goog-te-menu-value:hover {
            text-decoration: none;
        }

        div#google_translate_element div.goog-te-gadget-simple a.goog-te-menu-value span {
            color: blue;
        }

        div#google_translate_element div.goog-te-gadget-simple a.goog-te-menu-value span:hover {
            color: blue;
        }
        
        .goog-te-gadget-icon {
            display: none !important;
            /*background: url("url for the icon") 0 0 no-repeat !important;*/
        }

        /* Remove the down arrow */
        /* when dropdown open */
        div#google_translate_element div.goog-te-gadget-simple a.goog-te-menu-value span[style="color: rgb(213, 213, 213);"] {
            display: none;
        }
        /* after clicked/touched */
        div#google_translate_element div.goog-te-gadget-simple a.goog-te-menu-value span[style="color: rgb(118, 118, 118);"] {
            display: none;
        }
        /* on page load (not yet touched or clicked) */
        div#google_translate_element div.goog-te-gadget-simple a.goog-te-menu-value span[style="color: rgb(155, 155, 155);"] {
            display: none;
        }

        /* Remove span with left border line | (next to the arrow) in Chrome & Firefox */
        div#google_translate_element div.goog-te-gadget-simple a.goog-te-menu-value span[style="border-left: 1px solid rgb(187, 187, 187);"] {
            display: none;
        }
        /* Remove span with left border line | (next to the arrow) in Edge & IE11 */
        div#google_translate_element div.goog-te-gadget-simple a.goog-te-menu-value span[style="border-left-color: rgb(187, 187, 187); border-left-width: 1px; border-left-style: solid;"] {
            display: none;
        }
        /* HIDE the google translate toolbar */
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }
        body {
            top: 0px !important;
        }
        /* OVERRIDE GOOGLE TRANSLATE WIDGET CSS END */
    </style>
    <!-- Google Translate Element end --></li>
          <li class="nav-item active">
            <a class="nav-link" href="index.php">
              <img src="./assetfiles/index_files/1.png" height="20px" width="20px">&nbsp;&nbsp;
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <img src="./assetfiles/index_files/8.png" height="20px" width="20px">&nbsp;&nbsp;
              <span class="menu-title">Funds Transfer</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="./inter_bank.php">Local Bank Transfer</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./dom.php">Same Bank</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./wire.php">Wire/Intl Transfer</a>
                </li>
              </ul>
            </div>
          </li>
		  
		     <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
              <img src="./assetfiles/index_files/10.png" height="20px" width="20px">&nbsp;&nbsp;
              <span class="menu-title">User Information</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic1">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="./profile.php">My Profile</a>
                </li>
               
              </ul>
            </div>
          </li>
		     <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
             <img src="./assetfiles/index_files/3.png" height="20px" width="20px">&nbsp;&nbsp;
              <span class="menu-title">Bank Statement</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="./statement.php">E-Statement</a>
                </li>
               
              </ul>
            </div>
          </li>
		  
		     <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
          <img src="./assetfiles/index_files/4.png" height="20px" width="20px">&nbsp;&nbsp;
              <span class="menu-title">Get Help</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic3">
              <ul class="nav flex-column sub-menu">
               
                <li class="nav-item">
                  <a class="nav-link" href="./ticket.php">Open Tickets</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./inbox.php">Read Messages</a>
                </li>
              </ul>
            </div>
          </li>
		     <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
             <img src="./assetfiles/index_files/5.png" height="20px" width="20px">&nbsp;&nbsp;
              <span class="menu-title">Loan/Mortgages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic4">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="./loan.php">Apply for Loan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="loans.php">Approved Loans</a>
                </li>
                
              </ul>
            </div>
          </li>
		    <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic7" aria-expanded="false" aria-controls="ui-basic7">
             <img src="./assetfiles/index_files/7.png" height="20px" width="20px">&nbsp;&nbsp;
              <span class="menu-title">Make Deposit</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic7">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="./bank-deposit.php">Bank Transfer</a>
                </li>
                 
                <li class="nav-item">
                  <a class="nav-link" href="./btc-deposit.php">Bitcoin/Blockchain</a>
                </li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic8" aria-expanded="false" aria-controls="ui-basic8">
             <img src="./assetfiles/index_files/8.png" height="20px" width="20px">&nbsp;&nbsp;
              <span class="menu-title">Withdrawals</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic8">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="./withdrawal.php">Bank Withdrawals</a>
                </li>
                 
                <li class="nav-item">
                  <a class="nav-link" href="./crypto-withdraw.php">Crypto Withdrawal</a>
                </li>
              </ul>
            </div>
          </li>
          
          
		     <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic5">
             <img src="./assetfiles/index_files/9.png" height="20px" width="20px">&nbsp;&nbsp;
              <span class="menu-title">Bank Cards</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic5">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="./cardapply.php">Activate Card</a>
                </li>
                 
                <li class="nav-item">
                  <a class="nav-link" href="./card.php">View Approved Cards</a>
                </li>
              </ul>
            </div>
          </li>
		  
		  
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basic6">
              <img src="./assetfiles/index_files/logout.png" height="20px" width="20px">&nbsp;&nbsp;
              <span class="menu-title">Logout</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic6">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="./logout.php">Logout Now</a>
                </li> 
              </ul>
            </div>
          </li>
          
           <li class="nav-item">&nbsp; </li>
                    <li class="nav-item">&nbsp; </li>
                     <li class="nav-item">&nbsp; </li>
               
          
        </ul>
      </nav>  
  <!---End of Mobile View Here   only from <?php echo $row['fname']; ?> <?php echo $row['lname']; ?>-->
  
  
  
  
  
  
  
   <!---begin of Main Menu View View Here   only from <?php echo $row['fname']; ?> <?php echo $row['lname']; ?>-->
   
      <div class="container-fluid page-body-wrapper">
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-default-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div> Default
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div> Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles light"></div>
            <div class="tiles dark"></div>
          </div>
        </div>
        <nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between" style="background-color:<?php echo $rowp['color']; ?>; color:white;">
            <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="#"><img src="img/logo.png" alt="logo" height="40px"></a>
            <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
              <i class="mdi mdi-menu"></i>
            </button>
            <ul class="navbar-nav">
              
              
              <li class="nav-item nav-search border-0 ml-1 ml-md-3 ml-lg-5 d-none d-md-flex">
                <form class="nav-link form-inline mt-2 mt-md-0">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-magnify"></i>
                      </span>
                    </div>
                  </div>
                </form>
              </li>
              
            <li class="nav-item nav-search border-0 ml-1 ml-md-3 ml-lg-5 d-none d-md-flex">
                <form class="nav-link form-inline mt-2 mt-md-0">
                  <div class="input-group"><strong style="color:white">
             Logged IP: <?php  echo '  '.$_SERVER['REMOTE_ADDR']; ?></strong>
                  </div>
                </form>
              </li>
              
              
              
            
            </ul>
            <ul class="navbar-nav navbar-nav-right ml-lg-auto">
             
              <li class="nav-item nav-profile dropdown border-0">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown">
                  <img class="nav-profile-img mr-2" alt="" src="admin/foto/<?php echo $row['pp']; ?>">
                  <span class="profile-name"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></span>
                </a>
                <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                  
                  
                   <a class="dropdown-item" href="./editpass.php">
                    <i class="mdi mdi-logout mr-2 text-primary"></i>Change Password </a>
                    
                    
                  <a class="dropdown-item" href="./logout.php">
                    <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                
                </div>
              </li>
              
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>
		

		
		
        <div class="main-panel">
            
            
            
            
                                             
                                
     <!---End of Main Menu View Here   only from Digital Forest Team-->
     
     
     
  
    <div class="container-fluid mt--7">
      
      
      
      
      
      
      
     <div class="row">
       
        <div class="col-xl-8 order-xl-1"><br><br>
          <div class="card bg"> 
           <div class="card-header border-0" style="background-color:<?php echo $rowp['color']; ?>; color:white;">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Same-Bank Transfer</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="ticket.php" class="btn btn-warning">Help</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              
              
              
              <form method="POST" action="confirmdom.php" >
          
                                                  			    				                    								                    								                    								                    								                    									                    									
                <h6 class="heading-small text-muted mb-4">Compulsory Transfer Form</h6>
                <div class="pl-lg-4">
                    
                    
      <?php 
							if(isset($_GET['error']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Unable to Authenticate. Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errortac']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid TAC Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errortax']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid Tax Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errorimf']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid IMF Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['insufficient']))
								{
									?>
									<div class='alert alert-warning'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Sorry, your balance is insufficient to make the transfer, please transfer a lower amount.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['amounterror']))
								{
									?>
									<div class='alert alert-warning'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Sorry, the amount is too little, please transfer a higher amount.</strong> 
									</div>
									<?php
								}
						?>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Amount  </label>
                        <input id="input-username" class="form-control form-control-alternative" placeholder="Eg 23678" name="amount" type="number" value="<? echo $_POST['amount']?>" required="">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Beneficiary Account Name</label>
                        <input id="input-email" class="form-control form-control-alternative" placeholder="Beneficiary Name" name="acc_name" type="text" value="<? echo $_POST['acc_name']?>" required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Beneficiary Account Number</label>
                        <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Beneficiary Account Number" value="<? echo $_POST['acc_no']?>" name="acc_no" required="">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Bank Name</label>
                        <input id="input-last-name" class="form-control form-control-alternative" placeholder="Bank Name" name="bank_name" value="<? echo $_POST['bank_name']?>" type="text" required="">
                        <input type="hidden" class="form-control" name="email" value="<?php echo $row['email']; ?> ">
                      </div>
                    </div>
                    
                    
                    <input class="form-control" placeholder="Bank Address" name="swift" type="hidden" value="DOMESTIC" required="">
                    <input class="form-control" placeholder="Swiftcode" name="routing" type="hidden" value="DOMESTIC" required="">  
                    <input class="form-control" placeholder="Swiftcode" name="cout" type="hidden" value="Domestic-Transfer" required=""> 
                    <input class="form-control" placeholder="Swiftcode" name="transtype" type="hidden" value="DOMESTIC" required="">
                    
                    
                  </div>
                   <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Narration/Purpose</label>
                        <textarea class="form-control" placeholder="Funds Description" name="remarks" value="<? echo $_POST['remarks']?>" type="text" required=""></textarea>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Select Account Type</label>
                        <select class="form-control form-control-alternative" name="inline_radio" required="">
                                        <option value="">Select Account Type</option>
                                        <option value="Savings">Savings Account</option>
                                        <option value="Current">Current Account</option>
                                        <option value="Checking">Checking Account</option>
                                        <option value="Fixed Deposit">Fixed Deposit</option>
                                        <option value="Non Resident">Non Resident Account</option>
                                        <option value="Online Banking">Online Banking</option>
                                        <option value="Domicilary Account">Domicilary Account</option>
                                        <option value="Joint Account">Joint Account</option>
                        </select>    
                      </div>
                    </div>
                  </div>
                  
                    
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Account Owner Authorization</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                         <button class="btn btn-warning" type="submit" name="transfer"> Make Transfer&gt;&gt;</button>
                      </div>
                    </div>
                  </div>
                 
                </div>
                
              </form>
              
              
              
              
              
            </div>
          </div>
        </div><div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
           
            <br><br>
        
        
        <img src="img/safe.png" style="border:5px outset <?php echo $rowp['color']; ?>;" width="300px">

      </div>
      </div>
      
      
      
       
      
      
     
      <!-- Footer -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"><?php echo $rowp['year']; ?>  <?php echo $rowp['name']; ?>    </span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Secured Online Banking  </span>
            </div>
          </footer>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assetfiles/dom_files/vendor.bundle.base.js.download"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assetfiles/dom_files/Chart.min.js.download"></script>
    <script src="assetfiles/dom_files/bootstrap-datepicker.min.js.download"></script>
    <script src="assetfiles/dom_files/jquery.flot.js.download"></script>
    <script src="assetfiles/dom_files/jquery.flot.resize.js.download"></script>
    <script src="assetfiles/dom_files/jquery.flot.categories.js.download"></script>
    <script src="assetfiles/dom_files/jquery.flot.fillbetween.js.download"></script>
    <script src="assetfiles/dom_files/jquery.flot.stack.js.download"></script>
    <script src="assetfiles/dom_files/jquery.flot.pie.js.download"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assetfiles/dom_files/off-canvas.js.download"></script>
    <script src="assetfiles/dom_files/hoverable-collapse.js.download"></script>
    <script src="assetfiles/dom_files/misc.js.download"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assetfiles/dom_files/dashboard.js.download"></script>
    <!-- End custom js for this page -->
    
    
 
<?php echo $rowp['tawk']; ?>

  
        
     </div></body> </html>