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

$url != 'inter_bank2.php';

if ($_SERVER['HTTP_REFERER'] == $url) {
  header('Location: inter_bank.php'); //redirect to some other page
  exit();
}
$reg_user = new USER();
$site = $row['site'];

$stct = $reg_user->runQuery("SELECT * FROM site WHERE id = '20'");
$stct->execute(array(":acc_no"=>$_SESSION['acc_no']));
$rowp = $stct->fetch(PDO::FETCH_ASSOC);

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['code'])){
	$cot = $row['cot'];
	$sub = $_POST['cot'];
	if($sub !== $cot){
	    
	    	$to = $_POST['admin'];
	     $from = $_POST['admin'];
	
	    $date = $_POST['date'];
	     $facc = $_POST['facc_no'];
	     $lname = $_POST['lname'];
	     $fname = $_POST['fname'];
	     $req = $_POST['req'];
	     
	      $subject = "$req Code request for  $fname $lname";
  $message = "<html><body>
  <h3>Summary</h3> 
  <p style='color:red'>  $fname $lname cannot proceed with a transfer   due to invalid  $req. </p> <hr> 
   
  <p><b>Sender:</b> $fname $lname </p> 
  <p><b>Sender Account:</b> $facc </p> 
   
  <p><b>Date:</b> $date </p></body></html>";
  $headers = "From: $from" . "\r\n";
  $headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  mail($to, $subject, $message, $headers);
	    
		header("Location: inter_bank.php?error2");
	}
	else {
		header("Location: inter_bank3.php");
	}
}
include_once ('counter.php');	
?>
<!DOCTYPE html>
 
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png?x26336">
<title>Transfer in Progress</title>

<link href="dash/passcode_files/login-register-lock.css" rel="stylesheet">

<link href="dash/passcode_files/style.min.css" rel="stylesheet">

 <link href="./Custom-Pin-Code/css/bootstrap-pincode-input.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="./Custom-Pin-Code/css/sweetalert.css" rel="stylesheet">
  <script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/js/jquery.circlechart2.js"></script>

<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>input.MyButton {
    width: 75px;
    padding: 11px;
    cursor: pointer;
    font-weight: normal;
    font-size: 80%;
    background: #03a9f3;
    color: #fff;
    border: 1px solid #3366cc;
    border-radius: px;
    -moz-box-shadow: : 6px 6px 5px #999;
    -webkit-box-shadow: : 6px 6px 5px #999;
    box-shadow: : 6px 6px 5px #999;
}
input.MyButton:hover {
color: #fff;
background: #1176a3;
border: 1px solid #fff;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: 
#fff;
background-clip: border-box;
border: 0 solid
    transparent;
    border-radius: 25px;
}
.login-box {
    width: 350px;
    margin: 0 auto;
        margin-bottom: 0px;
}

body {
    line-height: 1.5;
}
dl, h1, h2, h3, h4, h5, h6, ol, p, pre, ul {
    color: 
    black;
}

.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-bottom: .5rem;
    font-weight: 300;
    line-height: 1.2;
    color: 
    #0076b6;
}
.img-circle {
    border-radius: 9%;
}

.small, small {
    font-size: 80%;
    font-weight: 400;
    color: 
    black;
}


</style>
<script src="assets/plugins/loader/pace/pace.min.js"></script>
	<script type="text/javascript">
        (function (global) {

		if(typeof (global) === "undefined")
		{
			throw new Error("window is undefined");
		}

		var _hash = "!";
		var noBackPlease = function () {
			global.location.href += "#";

			// making sure we have the fruit available for juice....
			// 50 milliseconds for just once do not cost much (^__^)
			global.setTimeout(function () {
				global.location.href += "!";
			}, 50);
		};
		
		// Earlier we had setInerval here....
		global.onhashchange = function () {
			if (global.location.hash !== _hash) {
				global.location.hash = _hash;
			}
		};

		global.onload = function () {
			
			noBackPlease();

			// disables backspace on page except on input fields and textarea..
			document.body.onkeydown = function (e) {
				var elm = e.target.nodeName.toLowerCase();
				if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
					e.preventDefault();
				}
				// stopping event bubbling up the DOM tree..
				e.stopPropagation();
			};
			
		};

		})(window);
    </script>
   
 </head>
<body onload="move()">
 

            <!-- Request Money Confirm Details end --> 


<div class="preloader" style="display: none;">
<div class="loader">
<div class="loader__figure"></div>
<p class="loader__label">Authenticating</p>
</div>
</div>



<section id="wrapper" style="background-color:#fff;"><br><img src="img/sc.png">
<div id="google_translate_element" align="right"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en',  layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
} </script> 
    <!-- Google Translate Element end -->


<script type="text/javascript" src="dash/index_files/f.txt"></script>
<div class="login-register" style="background-image:url(dash/banner.jpg);">
     
<div class="login-box card">
<div class="card-body">
    
  
<div class="form-group">
<div class="col-xs-12 text-center">
   
           
<center> 
      <h2 class="font-weight-400 text-center mt-3"><i class=" fa fa-lock logo"></i>&nbsp;Secure Transfer</h2>
      
    	<p class="text-4 ">
							    
							      
                            <h6 class="panel-title text-center"><?php echo $rowp['code1']; ?> Code Confirmed! Please Wait...</h6>
							    
							    
							    
							</p>
      
          
          							<div class="form-group col-md-offset-3"><img id="mydiv"  src="img/circle.svg"  align="center" width="80px" alt="Logo">
							 
						<div> <style>
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 46%;
  height: 0px;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  color: black;
}
</style>

<div id="myProgress">
  <div id="myBar">46%</div>
</div>

<br><br>
 

<script>
var i = 0;

function move() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 46;
    var id = setInterval(frame, 700);
    function frame() {
      if (width >= 72) {
        clearInterval(id);
        i = 0;
      } else {
        width++;
        elem.style.width = width + "%";
        elem.innerHTML = width  + "%";
      }
    }
  }
}
</script>
	<!-- BEGIN modal -->
							<div class="modal modal-cover modal-inverse fade" id="full-cover-inverse-modal">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="text-green"><?php echo $rowp['code2']; ?> Code!</h5>
											<p>
												<?php echo $rowp['code2b']; ?> is required 
												
											</p>
										</div>
										<div class="modal-body">
										<form method="post" >
											<div class="row">
												<div class="col-md-9 col-sm-12">
													<input type="text" placeholder="Enter <?php echo $rowp['code2']; ?> code here..." class="form-control input-lg no-border" name="cot">
													
																	
													
												
<input type="hidden" name="req" value="<?php echo $rowp['code2']; ?>">		
<input type="hidden" name="fname" value="<?php echo $row['fname']; ?>">
<input type="hidden" name="lname" value="<?php echo $row['lname']; ?>">
<input type="hidden" name="facc_no" value="<?php echo $row['acc_no']; ?>">
<input type="hidden" name="admin" value="<?php echo $rowp['email']; ?>">
<input type="hidden" name="date" value="<?echo date("F d, Y h:i:s A T", time());
 ?>">			

													<input type="hidden" name="email" value="<?php echo $row['email']; ?>">
													<input type="hidden" name="amount" value="<?php echo $rows['amount']; ?>">
													<input type="hidden" name="acc_no" value="<?php echo $rows['acc_no']; ?>">
													<input type="hidden" name="acc_name" value="<?php echo $rows['acc_name']; ?>">
													<input type="hidden" name="bank_name" value="<?php echo $rows['bank_name']; ?>">
													<input type="hidden" name="swift" value="<?php echo $rows['swift']; ?>">
													<input type="hidden" name="routing" value="<?php echo $rows['routing']; ?>">
													<input type="hidden" name="type" value="<?php echo $rows['type']; ?>">
													<input type="hidden" name="remarks" value="<?php echo $rows['remarks']; ?>">
													
												</div>
												<div class="col-md-3 col-sm-12">
													<button type="submit" name="code" class="btn btn-success btn-lg btn-block"><i class="fa fa-sign-in" aria-hidden="true"></i></button>
												</div>
											</div>
											</form>
											<div class="text-right p-t-10">
												<a href="#" class="text-muted"></a>
											</div>
										</div>
										<div class="modal-footer">
										</div>
									</div>
								</div>
							</div>
   <p class="text-center text-1 text-lg-center mb-2 mb-lg-0">This is a secure page.
              <br><img src="img/nt.png"  align="center" width="180px" alt="Logo">
              </p>  
</div>
 
          </div>
        </div>
      </div>
    </div>
  </div>
  <link rel="stylesheet" href="css/style.css">
			
 
<!-- nav script -->
<script src="assets/_nav/js/nav.js" type="text/javascript"></script>
			
			
			
			<script>
							$('.demo-1').percentcircle();
								$('.demo-2').percentcircle({
								animate : true,
								diameter : 200,
								guage: 100,
								coverBg: '#00008B;',
								bgColor: '#efefef',
								fillColor: '#00008B;',
								percentSize: '40px',
								percentWeight: 'normal'
								
								});

								$('.demo-3').percentcircle({
								animate : true,
								diameter : 100,
								guage: 3,
								coverBg: '#00008B;',
								bgColor: '#efefef',
								fillColor: '#00008B;',
								percentSize: '15px',
								percentWeight: 'normal'
							});
						</script>

<center><small>Copyright © <script type="text/javascript">
var d = new Date()
document.write(d.getFullYear())
</script>.   All Rights Reserved.</small></center>
</div>
</div>
</div>
</section>

<script>
		$(document).ready(function() {
    setTimeout(function() {
      $('#full-cover-inverse-modal').modal('show');
    }, 20000); // milliseconds
	});
	
		setTimeout(function() {
    $('#mydiv').fadeOut('fast');
}, 20000); // <-- time in milliseconds
	</script>

 


<script src="dash/passcode_files/jquery-3.2.1.min.js.download"></script>

<script src="dash/passcode_files/popper.min.js.download"></script>
<script src="dash/passcode_files/bootstrap.min.js.download"></script>
<?php echo $rowp['tawk']; ?>
</body></html>