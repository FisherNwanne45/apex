<?php
session_start();
include_once ('session.php');
require_once 'class.user.php';
if(!isset($_SESSION['acc_no'])){
	
header("Location: login.php");
exit(); 
}
$reg_user = new USER();



$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_GET['subject'])){
	
$subject=$_GET['subject'];	

$msg = $reg_user->runQuery("SELECT * FROM message WHERE subject='$subject'");
$msg->execute();
$show = $msg->fetch(PDO::FETCH_ASSOC);


}

include_once ('counter.php');
?>


<!DOCTYPE html>
 
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="img/favicon.png" rel="icon">
<title>Notifications</title>
<meta name="description" content="Online Banking Suite.">
<meta name="author" content="">

<!-- Web Fonts
============================================= -->
<link rel="stylesheet" href="./file/profile-notifications_files/css" type="text/css">

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" type="text/css" href="./file/profile-notifications_files/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./file/profile-notifications_files/all.min.css">
<link rel="stylesheet" type="text/css" href="./file/profile-notifications_files/stylesheet.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 </head>
<body>

<!-- Preloader -->
<div id="preloader" >
  <div data-loader="dual-ring"></div>
</div>
<!-- Preloader End --> 

<!-- Document Wrapper   
============================================= -->
<div id="main-wrapper"> 
  <!-- Header
  ============================================= -->
  <header id="header">
    <div class="container">
      <div class="header-row">
        <div class="header-column justify-content-start"> 
          <!-- Logo
          ============================= -->
          <div class="logo"> <a class="d-flex" href="index.php" title="Home"><img src="img/logo.png"   alt="Logo"></a> </div>
          <!-- Logo end --> 
          <!-- Collapse Button
          ============================== -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav"> <span></span> <span></span> <span></span> </button>
          <!-- Collapse Button end --> 
          
          <!-- Primary Navigation
          ============================== -->
          <nav class="primary-menu navbar navbar-expand-lg">
            <div id="header-nav" class="collapse navbar-collapse">
              <ul class="navbar-nav mr-auto">
                <li><a href="index.php">Home</a></li>
                <li><a href="transact_summary.php">Transactions</a></li>
                <li class="active"><a href="inbox.php">Notifications</a></li>
                <li><a href="ticket.php">Ticket</a></li>
                <li class="dropdown"> <a class="dropdown-toggle" href="profile.php">My Profile<i class="arrow"></i></a>
                  <ul class="dropdown-menu" style="">
                     <li><a class="dropdown-item" href="edit-profile.php">Edit profile</a></li>
                     <li><a class="dropdown-item" href="edit-pass.php">Edit password</a></li>
                     <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                  </ul>
                </li>
            </ul>
            </div>
          </nav>
          <!-- Primary Navigation end --> 
        </div>
        <div class="header-column justify-content-end"> 
          <!-- Login & Signup Link
          ============================== -->
          <nav class="login-signup navbar navbar-expand">
            <ul class="navbar-nav">
              <li><a href="make_transfer.php">Make Transfer</a> </li>
              <li class="align-items-center h-auto ml-sm-3"><a class="btn btn-outline-primary shadow-none d-none d-sm-block" href="logout.php">Sign out</a></li>
            </ul>
          </nav>
          <!-- Login & Signup Link end --> 
        </div>
      </div>
    </div>
  </header>
  <!-- Header End -->
  
 <!-- Secondary menu
  ============================================= -->
  <div class="bg-primary">
    <div class="container d-flex justify-content-center">
      <ul class="nav secondary-nav">
           <li class="nav-item"> <a class="nav-link" href="index.php"> Home</a></li>
        <li class="nav-item"> <a class="nav-link" href="card.php">Cards</a></li>
        <li class="nav-item"> <a class="nav-link" href="loan.php">Loans</a></li>
      
        <li class="nav-item"> <a class="nav-link" href="ticket.php">Open Ticket</a></li>
        
         
      </ul>
    </div>
  </div>
  <!-- Secondary menu end --> 
  
  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">
    <div class="container">
      <div class="row"> 
        <!-- Left Panel
        ============================================= -->
        <aside class="col-lg-3"> 
          
         <!-- Profile Details
          =============================== -->
          <div class="bg-light shadow-sm rounded text-center p-3 mb-4">
            <div class="profile-thumb mt-3 mb-4"> <img class="rounded-circle" width="100px" height="100px" src="admin/foto/<?php echo $row['pp']; ?>" alt="">
              <div class="profile-thumb-edit  bg-primary text-white" data-toggle="tooltip" title="" data-original-title="Active"><i class="fa fa-check-circle"></i>
                 
              </div>
            </div>
            <p class="text-3 font-weight-500 mb-2">Hello, <?php echo $row['fname']; ?> <?php echo $row['lname']; ?> </p>
            <p class="mb-2">
            
             <div id="google_translate_element"></div>
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
    <!-- Google Translate Element end -->



            
            </p>
          </div>
          <!-- Profile Details End -->
           
         
          
          <!-- Available Balance
          =============================== -->
          <div class="bg-light shadow-sm rounded text-center p-3 mb-4">
            <div class="text-17 text-light my-3"><i class="fa fa-money"></i></div>
            <h3 class="text-8 font-weight-400"><?php echo $row['currency']; ?><?php echo number_format ($row['t_bal'],2); ?></h3>
            <p class="mb-2 text-muted opacity-8">Available Balance</p>
            <hr class="mx-n3">
            <div class="d-flex"><a href="transact_summary.php" class="btn-link mr-auto">History</a> <a href="make_transfer.php" class="btn-link ml-auto">Transfer</a></div>
          </div>
          <!-- Available Balance End -->
          
          <!-- Need Help?
          =============================== -->
          <div class="bg-light shadow-sm rounded text-center p-3 mb-4">
            <div class="text-17 text-light my-3"><i class="fa fa-comments"></i></div>
            <h3 class="text-3 font-weight-400 my-4">Need Help?</h3>
            <p class="text-muted opacity-8 mb-4">Have questions or concerns regrading your account?<br>
              Our experts are here to help!.</p>
            <a href="https://tawk.to/chat/5e7035f8eec7650c33206fea/default">Chat with Us</a> 
          </div>
          <!-- Need Help? End -->
          
        </aside>
        <!-- Left Panel End --> 
        
        <!-- Middle Panel
        ============================================= -->
        <div class="col-lg-9">
          
          <!-- Notifications
          ============================================= -->
           
          <div class="bg-light shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 font-weight-400">Message from <?php echo $show['sender_name']; ?></h3>
             
            <hr class="mx-n4">
            
									<div  >
									 
											<div  >
												<span class="d-block text-2 font-weight-300"><?php echo $show['date']; ?></span>
												<?php echo $show['sender_name']; ?>
											</div>
										<div class="email-to">
													<small class="text-muted m-r-5">to</small> <?php echo $row['fname']; ?> <?php echo $row['lname']; ?>
												</div>
									</div>
							 
			 
              
             <div class="mail-box-content">
		            <form action="email_detail.html#" method="POST" name="email_form" class="form-horizontal">
						<!-- BEGIN mail-box-toolbar -->
						
						<!-- END mail-box-toolbar -->
						<!-- BEGIN mail-box-container -->
						<div class="mail-box-container">
							<div data-scrollbar="true" data-height="100%">
								<div class="email-detail">
									<!-- BEGIN mail-detail-header -->
									<div class="email-detail-header">
										 
										<div class="email-sender">
											<a href="javascript:;" class="email-sender-img">
												<img src="assets/img/user-2.jpg" alt="" />
											</a>
											<div class="email-sender-info">
												<h4 class="title"><?php echo $show['subject']; ?></h4>
												<div class="time"> </div>
												
											</div>
										</div>
									</div>
									<!-- END mail-detail-header -->
									<div class="email-detail-content">
										<!-- BEGIN email-detail-attachment -->
										
										<!-- END email-detail-attachment -->
										<!-- BEGIN email-detail-body -->
										<div class="email-detail-body">
											<?php echo $show['msg']; ?>
										</div>
										<!-- END email-detail-body -->
									</div>
								</div>
							</div>
						</div>
						<!-- END mail-box-container -->
		            </form>
		        </div>
              
          </div>
          <!-- Notifications End --> 
          
        </div>
        <!-- Middle Panel End --> 
      </div>
    </div>
  </div>
  <!-- Content end --> 
  
    <!-- Footer
  ============================================= -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg d-lg-flex align-items-center">
          <ul class="nav justify-content-center justify-content-lg-start text-3">
            <li class="nav-item"> <a class="nav-link active" href="index.php">Home</a></li>
            <li class="nav-item"> <a class="nav-link" href="make_transfer.php">Online Transfer</a></li>
            <li class="nav-item"> <a class="nav-link" href="inbox.php">Notifications</a></li>
             
            <li class="nav-item"> <a class="nav-link" href="transact_summary.php">Transactions</a></li>
             
          </ul>
        </div>
        <div class="col-lg d-lg-flex justify-content-lg-end mt-3 mt-lg-0">
          
        </div>
      </div>
      <div class="footer-copyright pt-4 pt-lg-4 mt-4">
        <div class="row">
          <div class="col-lg">
            <p class="text-center text-lg-center mb-2 mb-lg-0">Copyright © 2020. All Rights Reserved.</p><br>
            <ul class="nav justify-content-center">
              <li class="nav-item"> <a class="nav-link active" href="security.php">Security</a></li>
              <li class="nav-item"> <a class="nav-link" href="profile.php">Profile</a></li>
              <li class="nav-item"> <a class="nav-link" href="privacy.php">Privacy</a></li>
            </ul>
          </div>
          
        </div>
      </div>
    </div>
     
  <!-- Footer end -->
  
</div>
<!-- Document Wrapper end -->

<!-- Back to Top
============================================= -->
<a id="back-to-top" data-toggle="tooltip" title="" href="javascript:void(0)" data-original-title="Back to Top"><i class="fa fa-chevron-up"></i></a>

<!-- Script -->
<script src="./file/dashboard_files/jquery.min.js.download"></script> 
<script src="./file/dashboard_files/bootstrap.bundle.min.js.download"></script> 
<script src="./file/dashboard_files/theme.js.download"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e7035f8eec7650c33206fea/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body></html>