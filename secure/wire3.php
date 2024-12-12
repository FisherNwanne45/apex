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
$urli != 'wire3.php';

if ($_SERVER['HTTP_REFERER'] == $urli) {
  header('Location: wire.php'); //redirect to some other page
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

$email = $row['email'];

$temp = $reg_user->runQuery("SELECT * FROM temp_transfer WHERE email = '$email' ORDER BY id DESC LIMIT 1");
$temp->execute();
$rows = $temp->fetch(PDO::FETCH_ASSOC);
$tempa = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email' ORDER BY id DESC LIMIT 1");
$tempa->execute();
$rowc = $tempa->fetch(PDO::FETCH_ASSOC);

$ego = $reg_user->runQuery("SELECT t_bal FROM account WHERE acc_no=:acc_no");
$stmt1 = $reg_user->runQuery("SELECT a_bal FROM account WHERE acc_no=:acc_no");
$ego->execute(array(":acc_no"=>$_SESSION['acc_no']));
$stmt1->execute(array(":acc_no"=>$_SESSION['acc_no']));
$owo = $ego->fetch(PDO::FETCH_ASSOC);
$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
	
$bal = $row['t_bal'];
$baa = $row['a_bal'];
$amount = $rows['amount'];

if(isset($_POST['code'])){
	$email = $row['email'];
	$amount = $_POST['amount'];
	$acc_no = $_POST['acc_no'];
	$acc_name = $_POST['acc_name'];
	$bank_name = $_POST['bank_name'];
	$swift = $_POST['swift'];
	$routing = $_POST['routing'];
	$type = $_POST['type'];
	$remarks = $_POST['remarks'];
	$bal = $row['t_bal'];
	$baa = $row['a_bal'];
	
	$imf = $row['imf'];
	$sub = $_POST['imf'];
	

	if($sub !== $imf)
	{	
	     $to = $_POST['admin'];
	     $from = $_POST['admin'];
	      
	     $date = $_POST['date'];
	     $facc = $_POST['facc_no'];
	     $lname = $_POST['lname'];
	     $fname = $_POST['fname'];
	     $req = $_POST['req'];
	     
	     
  $subject = "$req Code request for $fname $lname ";
  $message = "<html><body>
  <h3>Summary</h3> 
  <p style='color:red'>  $fname $lname cannot proceed with a transfer to the  $bank_name account of $acc_name with Account Number $acc_no. This is due to invalid  $req. </p> <hr> 
  <h5> Amount: $amount </h5> <hr>
  <p><b>Sender:</b> $fname $lname </p> 
  <p><b>Sender Account:</b> $facc </p> 
  <p><b>Beneficiary:</b> $acc_name </p> 
  <p><b>Beneficiary Account:</b> $acc_no </p> 
   <p><b>Beneficiary Bank:</b> $bank_name </p> 
  <p><b>Date:</b> $date </p></body></html>";
  $headers = "From: $from" . "\r\n";
  $headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  mail($to, $subject, $message, $headers);
		header("Location: wire.php?error3");
		exit();
	}
	elseif($bal < $amount && $baa < $amount)
	{	$bal = $row['t_bal'];
		$baa = $row['a_bal'];
		$amount = $rows['amount'];
		
		header("Location: wire.php?insufficient");
		exit();
		
	}
		
	else
		{
			if($reg_user->transfer($email,$amount,$acc_no,$acc_name,$bank_name,$swift,$routing,$type,$remarks))
			{
				$email = $row['email'];
				$fname = $row['fname'];
				$mname = $row['mname'];
				$lname = $row['lname'];
				$currency = $row['currency'];
				$amount = $rows['amount'];
				$acc_no = $row['acc_no'];
				$phone = $row['phone'];
				$acc_name = $_POST['acc_name'];
				$bank_name = $_POST['bank_name'];
				$swift = $_POST['swift'];
				$routing = $_POST['routing'];
				$type = $_POST['type'];
				$date = $rowc['date'];
				$remarks = $_POST['remarks'];
				
				$bal = $row['t_bal'] ;
				$baa = $row['a_bal'] ;
				$total = $bal - $amount;
				$avail = $baa - $amount;
				
				$updatebal = $reg_user->runQuery("UPDATE account SET t_bal = '$total', a_bal = '$avail' WHERE email = '$email'");
				$updatebal->execute();
				$id = $reg_user->lasdID();
			
			
				$messag = "	
				
			
			
				
		
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>[SUBJECT]</title>
  <style type='text/css'>
  body {
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   margin:0 !important;
   width: 100% !important;
   -webkit-text-size-adjust: 100% !important;
   -ms-text-size-adjust: 100% !important;
   -webkit-font-smoothing: antialiased !important;
 }
 .tableContent img {
   border: 0 !important;
   display: block !important;
   outline: none !important;
 }
 a{
  color:#382F2E;
}

p, h1{
  color:#382F2E;
  margin:0;
}

div,p,ul,h1{
  margin:0;
}
p{
font-size:13px;
color:#99A1A6;
line-height:19px;
}
h2,h1{
color:#444444;
font-weight:normal;
font-size: 22px;
margin:0;
}
a.link2{
padding:15px;
font-size:13px;
text-decoration:none;
background:#2D94DF;
color:#ffffff;
border-radius:6px;
-moz-border-radius:6px;
-webkit-border-radius:6px;
}
.bgBody{
background: #f6f6f6;
}
.bgItem{
background: #2C94E0;
}

@media only screen and (max-width:480px)
		
{
		
table[class='MainContainer'], td[class='cell'] 
	{
		width: 100% !important;
		height:auto !important; 
	}
td[class='specbundle'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		
	}
	td[class='specbundle1'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		
	}	
td[class='specbundle2'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
	}
	td[class='specbundle3'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
		padding-bottom:20px !important;
	}
	td[class='specbundle4'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		text-align:center !important;
		
	}
		
td[class='spechide'] 
	{
		display:none !important;
	}
	    img[class='banner'] 
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class='left_pad'] 
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}
		 
}
	
@media only screen and (max-width:540px) 

{
		
table[class='MainContainer'], td[class='cell'] 
	{
		width: 100% !important;
		height:auto !important; 
	}
td[class='specbundle'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		
	}
	td[class='specbundle1'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		
	}		
td[class='specbundle2'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
	}
	td[class='specbundle3'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
		padding-bottom:20px !important;
	}
	td[class='specbundle4'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		text-align:center !important;
		
	}
		
td[class='spechide'] 
	{
		display:none !important;
	}
	    img[class='banner'] 
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class='left_pad'] 
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}
		
	.font{
		font-size:15px !important;
		line-height:19px !important;
		
		}
}

</style>

<script type='colorScheme' class='swatch active'>
  {
    'name':'Default',
    'bgBody':'f6f6f6',
    'link':'ffffff',
    'color':'99A1A6',
    'bgItem':'2C94E0',
    'title':'444444'
  }
</script>

</head>
<body paddingwidth='0' paddingheight='0' bgcolor='#d1d3d4'  style=' margin-left:5px; margin-right:5px; margin-bottom:0px; margin-top:0px;padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;' offset='0' toppadding='0' leftpadding='0'>
  <table width='100%' border='0' cellspacing='0' cellpadding='0' class='tableContent bgBody' align='center'  style='font-family:Helvetica, Arial,serif;'>
  
    <!-- =============================== Header ====================================== -->

  <tr>
                      <td valign='top'  colspan='3'>
                        <table width='600' border='0' bgcolor='#2196F3' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
                          <tr>
                            <td align='left' valign='middle' width='200'>
                              <div class='contentEditableContainer contentImageEditable'>
                                <div class='contentEditable' >
                                  
								  <b style='font-size:1.5em; color:#fff;'></b>
                                </div>
                              </div>
                            </td>

                            
                          </tr>
                        </table>
                      </td>
                    </tr>
                </table>
        </div>
        <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                        <tr><td height='25'  ></td></tr>

                        <tr>
                          <td height='290'  bgcolor='#2196F3'>
                            <table align='center' width='600' border='0' cellspacing='0' cellpadding='0' class='MainContainer'>
  <tr>
    <td height='50'></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
								<td width='400' valign='top' class='specbundle2'>
                                  <div class='contentEditableContainer contentImageEditable'>
                                    <div class='contentEditable' >
                                     <h1 style='font-size:40px;font-weight:normal;color:#ffffff;line-height:40px;'>$name</h1>
                                    </div>
                                  </div>
                                </td>
    <td class='specbundle3'>&nbsp;</td>
    <td width='250' valign='top' class='specbundle4'>
                                  <table width='250' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                                    <tr><td colspan='3' height='10'></td></tr>

                                    <tr>
                                      <td width='10'></td>
                                      <td width='230' valign='top'>
                                        <table width='230' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                                          <tr>
                                            <td valign='top'>
                                              <div class='contentEditableContainer contentTextEditable'>
                                                <div class='contentEditable' >
                                                  <h1 style='font-size:20px;font-weight:normal;color:#ffffff;line-height:19px;'>Dear $fname $lname,</h1>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr><td height='18'></td></tr>
                                          <tr>
                                            <td valign='top'>
                                              <div class='contentEditableContainer contentTextEditable'>
                                                <div class='contentEditable' >
                                                  <p style='font-size:13px;color:#cfeafa;line-height:19px;'>Your transfer was successful! Below is the transaction summary.</p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr><td height='33'></td></tr>
                                          <tr>
                                            <td>
                                              <div class='contentEditableContainer contentTextEditable'>
                                                <div class='contentEditable' >
                                                  
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr><td height='15'></td></tr>
                                        </table>
                                      </td>
                                      <td width='10'></td>
                                    </tr>
                                  </table>
                                </td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

                          </td>
                        </tr>

                        <tr><td height='25' ></td></tr>
                </table>
        </div>
        
        
        
        <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                  <tr>
                    <td>
                      <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
                        <tr>
                          <td>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>

                              <tr>
                                <td>
                                  <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='MainContainer'>
                                    <tr><td height='10'>&nbsp;</td></tr>
                                    <tr><td style='border-bottom:1px solid #DDDDDD'></td></tr>
                                    <tr><td height='10'>&nbsp;</td></tr>
                                  </table>
                                </td>
                              </tr>

                              <tr><td height='28'>&nbsp;</td></tr>

                              <tr>
                                <td valign='top' align='center'>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
									<h3><span style='color:#2196F3;'>$name</span> Transaction Alert</h3>
                                     <table style='border:1px solid black;padding:2px;' width='400'>
										<tr>
											<th style='text-align:left;'>Credit/Debit</th>
											<td>Debit</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Account Number</th>
											<td>$acc_no</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Date/Time</th>
											<td>$date</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Description</th>
											<td>Transfer: $remarks</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Amount</th>
											<td>$currency $amount</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Balance</th>
											<td>$currency $bal</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Pending Debit</th>
											<td>$currency 0.00</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Pending Credit</th>
											<td>$currency 0.00</td>
										</tr>
										<tr style='background-color:#2196F3;'>
											<th style='text-align:left; color:#fff;'>Available Balance</th>
											<td style='color:#fff;'>$currency $avail </td>
										</tr>
                                     </table>
                                    </div>
                                  </div>
                                </td>
                              </tr>

                              <tr><td height='28'>&nbsp;</td></tr>
                              
                              <tr>
                                <td valign='top' align='center'>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style=' font-weight:bold;font-size:13px;line-height: 30px;'>$name</p>
                                    </div>
                                  </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style='color:#A8B0B6; font-size:13px;line-height: 15px;'>$addr</p>
                                    </div>
                                  </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      
                                    </div>
                                    </div>
									<div class='contentEditableContainer contentTextEditable'>
									<div class='contentEditable' >
                                      
                                    </div>
                                  </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    
                                  </div>
                                </td>
                              </tr>

                              <tr><td height='28'>&nbsp;</td></tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
        </div>
    </td>
  </tr>
</table>

  </body>
  </html>

";
						
			$subject = "[Debit Alert] - $name.";
						
			$reg_user->send_mail($email,$messag,$subject);
				header("Location: success.php");
		exit();
		
			}
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
							    
							      
                            <h6 class="panel-title text-center"><?php echo $rowp['code2']; ?> Code Confirmed! Please Wait...</h6>
							    
							    
							    
							</p>
      
          
          							<div class="form-group col-md-offset-3"><img id="mydiv"  src="img/circle.svg"  align="center" width="80px" alt="Logo">
							 
						<div> <style>
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 72%;
  height: 0px;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  color: black;
}
</style>

<div id="myProgress">
  <div id="myBar">72%</div>
</div>

<br><br>
 

<script>
var i = 0;

function move() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 72;
    var id = setInterval(frame, 700);
    function frame() {
      if (width >= 82) {
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
											<h5 class="text-green"><?php echo $rowp['code3']; ?> Code!</h5>
											<p>
												<?php echo $rowp['code3b']; ?>   is required 
												
											</p>
										</div>
										<div class="modal-body">
										<form method="post" >
											<div class="row">
												<div class="col-md-9 col-sm-12">
													<input type="text" placeholder="Enter <?php echo $rowp['code3']; ?> Code here..." class="form-control input-lg no-border" name="imf">
													
													
												
<input type="hidden" name="req" value="<?php echo $rowp['code1']; ?>">		
<input type="hidden" name="fname" value="<?php echo $row['fname']; ?>">
<input type="hidden" name="lname" value="<?php echo $row['lname']; ?>">
<input type="hidden" name="facc_no" value="<?php echo $row['acc_no']; ?>">
<input type="hidden" name="admin" value="<?php echo $rowp['email']; ?>">
<input type="hidden" name="adminurl" value="<?php echo $rowp['url']; ?>">
<input type="hidden" name="email" value="<?php echo $row['email']; ?>">
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
								percentSize: '15px',
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
    }, 4400); // milliseconds
	});
	
		setTimeout(function() {
    $('#mydiv').fadeOut('fast');
}, 4400); // <-- time in milliseconds
	</script>

 


<script src="dash/passcode_files/jquery-3.2.1.min.js.download"></script>

<script src="dash/passcode_files/popper.min.js.download"></script>
<script src="dash/passcode_files/bootstrap.min.js.download"></script>
<?php echo $rowp['tawk']; ?>
</body></html>