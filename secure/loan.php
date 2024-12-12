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
                                                  <p style='font-size:13px;color:#cfeafa;line-height:19px;'>Your Loan application was successfully opened! We will respond to your request within 24 hours. Below is the transaction summary.</p>
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
									<h3><span style='color:##2196F3;'>$name</span> Loan</h3>
                                     <table style='border:1px solid black;padding:2px;' width='400'>
										<tr>
											<th style='text-align:left;'>Loan Application Number</th>
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
			
			$subject = "Your Loan Application[$tc] Has Been Opened";
						
			$reg_user->send_mail($email,$message,$subject);	

			
			$msg = "

					<div class='alert alert-success'>

						<button class='close' data-dismiss='alert'>&times;</button>

						<strong>Loan Application Successfully Opened!</strong> ~$subject~

                     

			  		</div>

					";

		}

		else

		{

			echo "Sorry, Loan Application was not opened";

		}		

}

include_once ('counter.php');

?>


<?php include("header.php"); ?>
 <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-head-sub">
                                </div>
                                <div class="nk-block-between-md g-4 card-bordered">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title fw-normal">Loan / Mortgage.</h4>
                                        <div class="nk-block-des">
                                            <p>Apply for New  <?php echo $rowp['name']; ?> Loan.</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li><a href="loans.php" class="btn btn-secondary btn-light text-light"><span>Approved Loans</span><em class="icon ni ni-wallet-in"></em></a></li>
                                        </ul>

                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                        </div>
                    </div> 
                  <div class="card card-bordered">
               <div class="card-header font-weight-bold text-light" style="background-color:#033d75;">Loan Application</div>
          <div class="card-inner">
        <h5 class="card-title">Important tips</h5>
        
        <p class="card-text"><em class="icon ni ni-alert-circle text-danger" style="font-size: 18px; font-weight: 600;"></em> Select the appropriate category.</p>
        <p class="card-text"><em class="icon ni ni-alert-circle text-danger" style="font-size: 18px; font-weight: 600;"></em>   Kindly fill the corresponding form the selected category.
        </p>
         <p class="card-text" id="deposit"><em class="icon ni ni-alert-circle text-danger" style="font-size: 18px; font-weight: 600;"></em>  We’ll send you an email confirmation   once the loan application is approved. Upon approval, your account will be credited immediately!
        </p>
        
        <hr>
         <div class="card-body">  
              
             
                        
              
           <?php if(isset($msg)) echo $msg;  ?>
                
                 <br>
                
                <div class="pl-lg-4">
                  <div class="row"  >
                      
                         <div class="col-lg-4" style="background-color:black;color:white;padding:20px;"><h4 style="background-color:blue;color:white;padding:5px;" align="center">Personal / Student Loans</h4><br> <p align="center"><?php echo $row['currency']; ?>5,000 to <?php echo $row['currency']; ?>45,000 <br> <br> <a href="#div1"    onclick="openCity(event, 'div1')" align="center" class="tablinks btn btn-success">Select</a></p>
                         </div>
                    
                    <div class="col-lg-4" style="background-color:black;color:white;padding:20px;"><h4 style="background-color:blue;color:white;padding:5px;" align="center">Business/ Investment Loans </h4><br> <p align="center"><?php echo $row['currency']; ?>50,000 to unlimited <br>  <br><a   href="#div2"  onclick="openCity(event, 'div2')" align="center" class="tablinks btn btn-success">Select</a></p>
                     </div>
                    
                    <div class="col-lg-4" style="background-color:black;color:white;padding:20px;"><h4 style="background-color:red;color:white;padding:5px;" align="center">Company / Project<br> Loans</h4><br> <p align="center"> <?php echo $row['currency']; ?>50,000 to unlimited
                    <br> <br> <a   href="#div3"  onclick="openCity(event, 'div3')" align="center" class="tablinks btn btn-success">Select</a></p>
                     </div>
                 
                <script type = "text/javascript">
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script> 
<style>
    .tabcontent {
  display: none;
   
}
</style>

</div>
            </div>
                 <div class="pl-lg-4 tabcontent" id="div1" >
                      <form method="POST" c="" class="form-horizontal" data-toggle="validator" novalidate="true">
                  <br><br><h3>Personal / Student Loans</h3>
                  <div class="row" >
                   
                                       <div class="col-lg-6">
                      <div class="form-group">
                    
                       <br>
                       
                        <label class="form-label" for="input-username">Receiver (Customer Care Loan Department)</label>
                        <input id="input-username" class="form-control form-control-alternative" placeholder="Customer Care" name="amount" type="text" disabled="">
                      </div>
                    </div>
                    
                 
                    <div class="col-lg-6">
                        <br>
                       
                      <div class="form-group">
                        <label class="form-label" for="input-email">Loan Amount: 5,000 - 45,000 (<?php echo $row['currency']; ?>)</label>
                        <input id="input-email" class="form-control form-control-alternative" name="subject" placeholder="Loan amount cannot exceed $45,000" type="number" required=""  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "5">
                         
                        <input type="hidden" class="form-control"  name="sender_name" value="<?php echo $row['fname']; ?> " >
                      </div>
                    </div>
                  </div>
                  
                  <br>
                  
                      <div class="form-group">
                        <label class="form-label" for="input-first-name">Narration/Purpose</label>
                        <textarea class="form-control" name="msg" placeholder="Write a purpose for the loan, and specify your preferred repayment plan and duration " type="text" required=""></textarea>
                      </div>
             
                    <br><p class="title lead">You are requesting for a Personal / Student loan, By continuing, you have agreed and accepted the <?php echo $rowp['name']; ?> digital loan terms and conditions.</p>
                                        <strong class="text-center bold">Terms & Conditions</strong>
                                                        <ul class="list list-sm list-checked">
                                                            <li>Interest Rate: 2.5%.</li>
                                                            
                                                            <li>Repayment must be made according to my preffered repayment tenure.</li>
                                                            <li>I waive 3-days maximum cooling off period to enable disbursement.</li>
                                                            <li>I accept that <?php echo $rowp['name']; ?> reserved the right to decline my loan request.</li>
                                                        </ul><br>
                 <input type="submit" name="ticket" class="btn btn-warning" value="CLICK TO APPLY"><br>
                </div>
                 
               
                
              </form>
              
              
              
              <div class="pl-lg-4 tabcontent" id="div2" >
                      <form method="POST" c="" class="form-horizontal" data-toggle="validator" novalidate="true">
                  <br><br><h3>Business/ Investment Loans</h3>
                  <div class="row" >
                   
                                       <div class="col-lg-6">
                      <div class="form-group">
                    
                       <br>
                       
                        <label class="form-label" for="input-username">Receiver (Customer Care Loan Department)</label>
                        <input id="input-username" class="form-control form-control-alternative" placeholder="Customer Care" name="amount" type="text" disabled="">
                      </div>
                    </div>
                    
                 
                    <div class="col-lg-6">
                        <br>
                       
                      <div class="form-group">
                        <label class="form-label" for="input-email">Loan Amount: 50,000 - Unlimited (<?php echo $row['currency']; ?>)</label>
                        <input id="input-email" class="form-control form-control-alternative" name="subject" placeholder="Loan amount " type="number" required=""  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "8">
                         
                        <input type="hidden" class="form-control"  name="sender_name" value="<?php echo $row['fname']; ?> " >
                      </div>
                    </div>
                  </div>
                  
                  <br>
                  
                      <div class="form-group">
                        <label class="form-label" for="input-first-name">Narration/Purpose</label>
                        <textarea class="form-control" name="msg" placeholder="Write a purpose for the loan, and specify your preferred repayment plan and duration " type="text" required=""></textarea>
                      </div>
             
                    <br><p class="title lead">You are requesting for a Business/ Investment Loan, By continuing, you have agreed and accepted the <?php echo $rowp['name']; ?> digital loan terms and conditions.</p>
                                        <strong class="text-center bold">Terms & Conditions</strong>
                                                        <ul class="list list-sm list-checked">
                                                            <li>Interest Rate: 2.5%.</li>
                                                            
                                                            <li>Repayment must be made according to my preffered repayment tenure.</li>
                                                            <li>I waive 3-days maximum cooling off period to enable disbursement.</li>
                                                            <li>I accept that <?php echo $rowp['name']; ?> reserved the right to decline my loan request.</li>
                                                        </ul><br>
                 <input type="submit" name="ticket" class="btn btn-warning" value="CLICK TO APPLY"><br>
                </div>
                 
               
                
              </form>
              
              
              <div class="pl-lg-4 tabcontent" id="div3" >
                      <form method="POST" c="" class="form-horizontal" data-toggle="validator" novalidate="true">
                  <br><br><h3>Company Loans</h3>
                  <div class="row" >
                   
                                       <div class="col-lg-6">
                      <div class="form-group">
                    
                       <br>
                       
                        <label class="form-label" for="input-username">Receiver (Customer Care Loan Department)</label>
                        <input id="input-username" class="form-control form-control-alternative" placeholder="Customer Care" name="amount" type="text" disabled="">
                      </div>
                    </div>
                    
                 
                    <div class="col-lg-6">
                        <br>
                       
                      <div class="form-group">
                        <label class="form-label" for="input-email">Loan Amount: 50,000 - Unlimited (<?php echo $row['currency']; ?>)</label>
                        <input id="input-email" class="form-control form-control-alternative" name="subject" placeholder="Loan amount " type="number" required=""  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "8">
                         
                        <input type="hidden" class="form-control"  name="sender_name" value="<?php echo $row['fname']; ?> " >
                      </div>
                    </div>
                  </div>
                  
                  <br>
                  
                      <div class="form-group">
                        <label class="form-label" for="input-first-name">Narration/Purpose</label>
                        <textarea class="form-control" name="msg" placeholder="Write a purpose for the loan, and specify your preferred repayment plan and duration " type="text" required=""></textarea>
                      </div>
             
                    <br><p class="title lead">You are requesting for a Company / Project Loan, By continuing, you have agreed and accepted the <?php echo $rowp['name']; ?> digital loan terms and conditions.</p>
                                        <strong class="text-center bold">Terms & Conditions</strong>
                                                        <ul class="list list-sm list-checked">
                                                            <li>Interest Rate: 2.5%.</li>
                                                            
                                                            <li>Repayment must be made according to my preffered repayment tenure.</li>
                                                            <li>I waive 3-days maximum cooling off period to enable disbursement.</li>
                                                            <li>I accept that <?php echo $rowp['name']; ?> reserved the right to decline my loan request.</li>
                                                        </ul><br>
                </div>
                 
               
                
              </form>
              
              
              
              
            </div>
          </div>
        
    
      
      
      
       
        
        
     
    </div>
</div>
 
<?php include("footer.php"); ?>