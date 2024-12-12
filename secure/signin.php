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
						<p class=' ' data-dismiss='alert'>Invalid Account No or Password! Ensure to enter correct information or contact customer service.</p>
						  <span><span>
                   
			  </div>";
}
elseif($status == 'Disabled'){
	$msg = "<div class='alert alert-inverse'>
						<button class=' ' data-dismiss='alert'>&times;</button>
						  <strong>Sorry! Your Account Has Been Disabled For Violation of Our Terms!</strong>
                   
			  </div>";
}
elseif($status == 'Closed'){
	$msg = "<div class='alert alert-inverse'>
						<button class=' ' data-dismiss='alert'>&times;</button>
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
        include('../config.php');
        $result = $conn->query("SELECT * FROM site");
        if(!$result->num_rows > 0){ echo '<h2 style="text-align:center;">No Data Found</h2>'; }
        while($rows = $result->fetch_assoc())
        {
      ?>


<!DOCTYPE html><html> 
<head><title>Login - <?php echo $rows['name']; ?></title><meta name="robots" content="noindex,nofollow">
<meta charset="utf-8">
<meta content="ie=edge" http-equiv="x-ua-compatible">
<meta content="template language" name="keywords">
<meta content="<?php echo $rows['name']; ?>" name="author">
<meta content="<?php echo $rows['name']; ?>" name="description">
<meta content="width=device-width,initial-scale=1" name="viewport">
<link rel="icon" href="img/favicon.png" >
<link href="../fast.fonts.net/cssapi/487b73f1-c2d1-43db-8526-db577e4c822b.html" rel="stylesheet">
<link href="private/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
<link href="private/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<link href="private/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
<link href="private/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="private/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
<link href="private/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
<link href="private/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
<link href="private/css/main.css?version=4.5.0" rel="stylesheet"></head>








<center>
    
<!-- GTranslate: https://gtranslate.io/ -->
<a href="#" onclick="doGTranslate('en|en');return false;" title="English" class="gflag nturl" style="background-position:-0px -0px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="English" /></a><a href="#" onclick="doGTranslate('en|fr');return false;" title="French" class="gflag nturl" style="background-position:-200px -100px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="French" /></a><a href="#" onclick="doGTranslate('en|de');return false;" title="German" class="gflag nturl" style="background-position:-300px -100px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="German" /></a><a href="#" onclick="doGTranslate('en|it');return false;" title="Italian" class="gflag nturl" style="background-position:-600px -100px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Italian" /></a><a href="#" onclick="doGTranslate('en|pt');return false;" title="Portuguese" class="gflag nturl" style="background-position:-300px -200px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Portuguese" /></a><a href="#" onclick="doGTranslate('en|ru');return false;" title="Russian" class="gflag nturl" style="background-position:-500px -200px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Russian" /></a><a href="#" onclick="doGTranslate('en|es');return false;" title="Spanish" class="gflag nturl" style="background-position:-600px -200px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16" alt="Spanish" /></a>

<style type="text/css">
<!--
a.gflag {vertical-align:middle;font-size:16px;padding:1px 0;background-repeat:no-repeat;background-image:url(//gtranslate.net/flags/16.png);}
a.gflag img {border:0;}
a.gflag:hover {background-image:url(//gtranslate.net/flags/16a.png);}
#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}
body {top:0 !important;}
#google_translate_element2 {display:none!important;}
-->
</style>

<br /><select onchange="doGTranslate(this);"><option value="">Select Language</option><option value="en|af">Afrikaans</option><option value="en|sq">Albanian</option><option value="en|ar">Arabic</option><option value="en|hy">Armenian</option><option value="en|az">Azerbaijani</option><option value="en|eu">Basque</option><option value="en|be">Belarusian</option><option value="en|bg">Bulgarian</option><option value="en|ca">Catalan</option><option value="en|zh-CN">Chinese (Simplified)</option><option value="en|zh-TW">Chinese (Traditional)</option><option value="en|hr">Croatian</option><option value="en|cs">Czech</option><option value="en|da">Danish</option><option value="en|nl">Dutch</option><option value="en|en">English</option><option value="en|et">Estonian</option><option value="en|tl">Filipino</option><option value="en|fi">Finnish</option><option value="en|fr">French</option><option value="en|gl">Galician</option><option value="en|ka">Georgian</option><option value="en|de">German</option><option value="en|el">Greek</option><option value="en|ht">Haitian Creole</option><option value="en|iw">Hebrew</option><option value="en|hi">Hindi</option><option value="en|hu">Hungarian</option><option value="en|is">Icelandic</option><option value="en|id">Indonesian</option><option value="en|ga">Irish</option><option value="en|it">Italian</option><option value="en|ja">Japanese</option><option value="en|ko">Korean</option><option value="en|lv">Latvian</option><option value="en|lt">Lithuanian</option><option value="en|mk">Macedonian</option><option value="en|ms">Malay</option><option value="en|mt">Maltese</option><option value="en|no">Norwegian</option><option value="en|fa">Persian</option><option value="en|pl">Polish</option><option value="en|pt">Portuguese</option><option value="en|ro">Romanian</option><option value="en|ru">Russian</option><option value="en|sr">Serbian</option><option value="en|sk">Slovak</option><option value="en|sl">Slovenian</option><option value="en|es">Spanish</option><option value="en|sw">Swahili</option><option value="en|sv">Swedish</option><option value="en|th">Thai</option><option value="en|tr">Turkish</option><option value="en|uk">Ukrainian</option><option value="en|ur">Urdu</option><option value="en|vi">Vietnamese</option><option value="en|cy">Welsh</option><option value="en|yi">Yiddish</option></select><div id="google_translate_element2"></div>
<script type="text/javascript">
function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'en',autoDisplay: false}, 'google_translate_element2');}
</script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


<script type="text/javascript">
/* <![CDATA[ */
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',43,43,'||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'),0,{}))
/* ]]> */
</script>



</center>









<body class="auth-wrapper">
<div class="all-wrapper menu-side with-pattern">
<div class="auth-box-w">
<div class="logo-w">
<a href="../index.php">
<img alt="" src="admin/site/<?php echo $rows['image']; ?>" width='180'></a></div>

	<?php 
				if(isset($_GET['inactive']))
				{
					?>
					<div class='alert alert-info col-4'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
					</div>
			<?php
				}
			?>	
			 <?php if(isset($msg)) echo $msg;  ?> 
               

<h6 class="auth-header">Login to <?php echo $rows['name']; ?>  </h6>
<form  method="post" class="row" name="LoginForm" autocomplete="off"  >
<div class="form-group">
<label for="">Account Number</label>
<input class="form-control" name="acc_no" id="acc_no" required placeholder="Enter your Account Number">
<div class="pre-icon os-icon os-icon-user-male-circle"></div></div>
<div class="form-group">
<label for="">Password</label>
<input class="form-control" placeholder="Enter your password" required name="upass" id="upass" type="password">
<div class="pre-icon os-icon os-icon-fingerprint"></div></div>
<div class="buttons-w">

<input type='submit' name='submit'  class="btn btn-primary" value='Log me in'>
<a class="btn btn-secondary" href='admin/eForm.php'>Register</a>
</form></div></div><!--Start of Tawk.to Script-->
<?php echo $rows['tawk']; ?>
<!--End of Tawk.to Script-->
  </body>

<!-- Mirrored from winsterbank.com/secure by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:49:44 GMT -->
</html> <?php } ?>