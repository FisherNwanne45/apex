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

$email = $row['email'];
$fname = $row['fname'];
$lname = $row['lname'];

if(isset($_POST['ticket']))

{

	$tc = rand(00000,99999);

	

	$sender_name = trim($_POST['sender_name']);

	$sender_name = strip_tags($sender_name);

	$sender_name = htmlspecialchars($sender_name);

	

	$sub = trim($_POST['subject']);

	$sub = strip_tags($sub);

	$sub = htmlspecialchars($sub);

	

	$msg = trim($_POST['msg']);

	$msg = strip_tags($msg);

	$msg = htmlspecialchars($msg);

	
	
	

	$tick = $reg_user->runQuery("SELECT * FROM ticket");

	

	$tick->execute();



	$show = $tick->fetch(PDO::FETCH_ASSOC);

	$date = $show['date'];

		if($reg_user->ticket($tc,$sender_name,$sub,$msg))

		{			

			$id = $reg_user->lasdID();	

			
			$message = "
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
    <td class='movableContentContainer' >
    	<div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                   <tr><td height='25'  colspan='3'></td></tr>

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
                                                  <p style='font-size:13px;color:#cfeafa;line-height:19px;'>Your Ticket application was successfully opened! We will respond to your request within 24 hours. Below is the transaction summary.</p>
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
									<h3><span style='color:##2196F3;'>$name</span> Ticket</h3>
                                     <table style='border:1px solid black;padding:2px;' width='400'>
										<tr>
											<th style='text-align:left;'>Ticket   Number</th>
											<td>$tc</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Subject</th>
											<td>$sub</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Date Opened</th>
											<td>$date</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Message</th>
											<td>$msg</td>
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
  </html>";
			
			$subject = "Your Ticket  [$tc] Has Been Opened";
						
			$reg_user->send_mail($email,$message,$subject);	

			
			$msg = "

					<div class='alert alert-success'>

						<button class='close' data-dismiss='alert'>&times;</button>

						<strong>Ticket   Successfully Opened!</strong> ~$subject~

                     

			  		</div>

					";

		}

		else

		{

			echo "Sorry, Ticket Application was not opened";

		}		

}

include_once ('counter.php');

?>
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
width: 250px;
height: 160px;
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
    width: 250px;
    height: 160px;c background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    background-color: #000;
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
    font-size: 13px;
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
    font-size: 9px;
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

 
</style>
 






<style>
 

.cardcc1{
width: 250px;
height: 160px;
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
    width: 250px;
    height: 160px;c background-repeat: no-repeat;
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
    font-size: 15px;
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
    font-size: 9px;
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
 
</style>
 

<?php include("header.php"); ?>
 <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-head-sub">
                                </div>
                                <div class="nk-block-between-md g-4 card-bordered">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title fw-normal">Card Application.</h4>
                                        <div class="nk-block-des">
                                            <p>Apply for New  <?php echo $rowp['name']; ?> Card.</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li><a href="card.php" class="btn btn-secondary btn-light text-light"><span>Approved Cards</span><em class="icon ni ni-wallet-in"></em></a></li>
                                        </ul>

                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                        </div>
                    </div> 
                  <div class="card card-bordered">
               <div class="card-header font-weight-bold text-light" style="background-color:#033d75;">Card Application</div>
          <div class="card-inner">
        <h5 class="card-title">Important tips</h5>
        
        <p class="card-text"><em class="icon ni ni-alert-circle text-danger" style="font-size: 18px; font-weight: 600;"></em> Select the appropriate category.</p>
        <p class="card-text"><em class="icon ni ni-alert-circle text-danger" style="font-size: 18px; font-weight: 600;"></em>   Kindly fill the corresponding form for the selected category.
        </p>
         
        
        <hr>
         <div class="card-body">  
              
             
                        
            <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                         <a href="#">
                       <div class="cardcc">
  <div class="cardcc__front cardcc__part">
    <img class="cardcc__front-square cardcc__square" src="img/card_files/chip.png">
    <img class="cardcc__front-logo cardcc__logo" src="img/card_files/mc.png">
    <p class="cardcc_numer"> PREMIUM-MASTER-CARD </p>
    <div class="cardcc__space-75">
      <span class="cardcc__label">card holder</span>
      <p class="cardcc__info"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></p>
    </div>
    <div class="cardcc__space-25">
      <span class="cardcc__label">TYPE</span>
            <p class="cardcc__info">PREMIUM</p>
    </div>
  </div>
  
  <div class="cardcc__back cardcc__part">
    <div class="cardcc__black-line"></div>
    <div class="cardcc__back-content">
      <div class="cardcc__secret">
        <p class="cardcc__secret--last"> <?php
 
   
$ccv = $row['cvv'];

if($ccv == "")
{
echo '  CVV   ';
} else {    echo $row['cvv'];
               
        }

?></p>
      </div>
      <img class="cardcc__back-square cardcc__square" src="img/card_files/chip.png">
      <img class="cardcc__back-logo cardcc__logo" src="img/card_files/visa.png">
      
    </div>
  </div>
  
</div>
<br><br>
<h4>Credit Card Charges: 0.2 BTC</h4> <br>  </a>
<p>
With MasterCard Chip & PIN technology, you can now shop in confidence with more than 2 million ATMs worldwide as it provides an added level of security.
  </p>

                <br>  <a href="card1.php" class="btn btn-primary">Select Premium Master card</a>
                
        
        <br><br>
       
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
               <a href="#" >
        <div class="cardcc1">
  <div class="cardcc1__front cardcc1__part">
    <img class="cardcc1__front-square cardcc1__square" src="./img/card_files/chip.png">
<img class="cardcc1__front-logo cardcc1__logo" src="img/card_files/visa.png" alt="logo" height="60px">
    <p class="cardcc1_numer"> LOAN-VISA-CARD </p>
    <div class="cardcc1__space-75">
      <span class="cardcc1__label">card holder</span>
      <p class="cardcc1__info"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></p>
    </div>
    <div class="cardcc1__space-25">
      <span class="cardcc1__label">Type</span>
            <p class="cardcc1__info" style="font-size:10px;">Savings</p>
    </div>
  </div>
  
  <div class="cardcc1__back cardcc1__part">
    <div class="cardcc1__black-line"></div>
    <div class="cardcc1__back-content">
      <div class="cardcc1__secret">
        <p class="cardcc1__secret--last">1234</p>
      </div>
      <img class="cardcc1__back-square cardcc1__square" src="./img/card_files/chip.png">
      <img class="cardcc1__back-logo cardcc1__logo" src="img/card_files/visa.png" alt="logo" height="40px">
      
    </div>
  </div>
  
</div> <br><br>
<h4> Credit Card Charges: 0.1 BTC</h4><br>  </a>
<p>

Credit Card carries the Visa logo, hence ensuring worldwide acceptability at more than 30 million establishments and 1.5 million ATMs worldwide.
 </p>

<br>  <a href="card2.php" class="btn btn-success">Select Loan Visa Card</a>
        
<br><br>

                      </div>
                    </div>
                  </div>
                  
                  
                  
              
              
              
            </div>
          </div>
        
    
      
      
      
       
        
        
     
    </div>
</div>
 
<?php include("footer.php"); ?>