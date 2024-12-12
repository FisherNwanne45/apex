<?php session_start(); 
$rand = get_rand_id(10);



function assign_rand_value($num)
{
// accepts 1 - 36
  switch($num)
  {
     
    case "1":
     $rand_value = "0";
    break;
    case "2":
     $rand_value = "1";
    break;
    case "3":
     $rand_value = "2";
    break;
    case "4":
     $rand_value = "3";
    break;
    case "5":
     $rand_value = "4";
    break;
    case "6":
     $rand_value = "5";
    break;
    case "7":
     $rand_value = "6";
    break;
    case "8":
     $rand_value = "7";
    break;
    case "9":
     $rand_value = "8";
    break;
    case "10":
     $rand_value = "9";
    break;
  }
return $rand_value;
}

function get_rand_id($length)
{
  if($length>0) 
  { 
  $rand_id="";
   for($i=1; $i<=$length; $i++)
   {
   mt_srand((double)microtime() * 1000000);
   $num = mt_rand(1,10);
   $rand_id .= assign_rand_value($num);
   }
  }
return $rand_id;
} 





?>

  
<!DOCTYPE html>
<html lang="en">
 <?php
        include('../config.php');
        $result = $conn->query("SELECT * FROM site");
        if(!$result->num_rows > 0){ echo '<h2 style="text-align:center;">No Data Found</h2>'; }
        while($row = $result->fetch_assoc())
        {
      ?>
  
<head>
<title> Signup - <?php echo $row['name']; ?> <?php echo $row['url']; ?></title>
<meta charset="utf-8">
<meta content="ie=edge" http-equiv="x-ua-compatible">
<meta content="template language" name="keywords">
<meta content="<?php echo $row['name']; ?>" name="author">
<meta content="<?php echo $row['name']; ?> Sign Up" name="description">
<meta content="width=device-width,initial-scale=1" name="viewport">
<link rel="icon" href="img/favicon.png" type="image/x-icon">
<link href="../fast.fonts.net/cssapi/487b73f1-c2d1-43db-8526-db577e4c822b.html" rel="stylesheet">
<link href="../private/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
<link href="../private/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<link href="../private/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
<link href="../private/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../private/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
<link href="../private/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
<link href="../private/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
<link href="../private/css2/main57395739.css?version=4.5.0" rel="stylesheet">
</head>










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







<body>
<div class="all-wrapper menu-side with-pattern">
<div class="auth-box-w wider">
<div class="logo-w">
<a href="../../index.php">
<img alt="" src="site/<?php echo $row['image']; ?>" width='180'></a></div>


<h4 class="auth-header">Personal Information</h4>
<form role="form" class="form-validation-1" method="POST" action="submit_form.php" enctype="multipart/form-data">
<div class="form-group">
<label for=""> First Name</label>
<input class="form-control" placeholder="Enter First Name" required name="fname" id="fname" type="text">
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for=""> Last Name</label>
<input class="form-control" placeholder="Enter Last Name" required name="lname" id="lname" type="text">
</div></div>
<div class="col-sm-6">
<div class="form-group">
<label for="">Username</label>
<input class="form-control" placeholder="Enter Username"  id="uname"   name="uname"   type="text"></div>
</div>
</div>

<div class="form-group">
<label for=""> Email address</label>
<input class="form-control" placeholder="Enter email" required id="email" name="email" type="email">
</div>

<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for=""> Password</label>
<input class="form-control" placeholder="Password" id="upass"   name="upass"  required type="password">
</div></div>
<div class="col-sm-6">
<div class="form-group">
<label for="">Confirm Password</label>
<input class="form-control" placeholder="Password" id="upass2"   name="upass2"  required type="password"></div>
</div>
</div>


<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for=""> Date of birth</label>
<input class="form-control" placeholder="Enter Date of birth" id="dob" name="dob" required type="date">
</div></div>
<div class="col-sm-6">
<div class="form-group">
<label for="">Gender</label><select name="sex"   id="sex" class="form-control">
<option value="Male" class="option">Male</option>
<option value="Female" class="option">Female</option>
</select>
</div>
</div>
</div>



<h4 class="auth-header">Contact Information</h4>

<div class="form-group">
<label for=""> Home Address</label>
<input class="form-control" placeholder="Enter Home Address" name="addr" id="addr" required type="text">
</div>

<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for=""> Country</label>
<input class="form-control" placeholder="Country" type="text"  name="nation" id="nation">
</div></div>
<div class="col-sm-6">
<div class="form-group">
<label for="">Zipcode</label>
<input class="form-control" placeholder="Enter Zipcode" required name="zip" type="text"></div>
</div>
</div>

<div class="form-group">
<label for=""> Phone Number</label>
<input class="form-control" placeholder="Enter Phone Number" name="phone" required type="text">
</div>

<h4 class="auth-header">Account Information</h4>

<div class="form-group">
<label for=""> Account 4-Digit Pin</label>
<input class="form-control" type="number" id="mname" pattern="\d{4}"  maxlength="4" name="mname"  placeholder="Secret Pin must be four digits">
</div>

<div class="row">
    
    <div class="col-sm-4">
<div class="form-group">
<label for="">Currency</label>
<select name="currency" id="currency" class="form-control" onchange="sig(this); ">
    <option value="$">Select </option>
  <option value="$">Dollar </option>

   <option value="£">Pounds  </option>

 <option value="€">Euro</option> 
 
 <option value="CHF">Swiss Franc</option> 
</select>

</div>
</div>


<div class="col-sm-8">
<div class="form-group">
<label for=""> Account Type</label>
<select name="type" id="type" class="form-control" onchange="openBal(this); "> 
 <option value="">Select Account Type</option>   

 <option value="1050 - Savings ">Savings Account (1,050) </option>

   <option value="3650 - Current  ">Current Account (3,650) </option>

 <option value="7500 - Checking  ">Checking Account (7,500)</option> 

 <option value="10000 - Fixed Deposit  ">Fixed Deposit Account (10,000)</option>   

												 </select>
</div></div>


</div>


<div class="form-group">
<label for="">Opening Balance: <font color="blue"> <span id="sig">Please wait...</span> </font><font color="blue"><span id="output"></span></font></label> 
</div>


<div class="form-group">
<label for="">Occupation</label>
<input class="form-control" placeholder="Enter Occupation" required name="work" id="work" type="text">
</div>



<div class="form-group">
<label for="">Upload Profile</label>
<input type="file" name="attachment" id="attachment" required class="form-control" />
</div>
<input type="hidden" id="output" name=t_bal value="" >
                                        <input type="hidden" id="output" name=a_bal value="" >
                                        <input type="hidden" name="admin" value="<?php echo $row['email']; ?>">
                                        <input type="hidden" name="adminurl" value="<?php echo $row['url']; ?>">
                                        <input type="hidden" id="output" name=loan value="" >
                                        <input type="hidden" id="status" name=status value="Dormant/Inactive" >
                                        <input type="hidden" name=pp value="user.png" >
                                        <input type="hidden" name=image value="user.png" >
                                        <input type="hidden" name=cot value="NOT SET - NEW ACC" >
                                        <input type="hidden" name=tax value="NOT SET - NEW ACC" >
                                        <input type="hidden" name=imf value="NOT SET - NEW ACC" >
                                        <input type="hidden" id="acc_no" name="acc_no" value="<?php echo strtoupper($rand); ?>" >

<input type="submit" name="register" id="register"  class="btn btn-primary" value='Register Now'>

<a class="btn btn-info"  href='../'>Already a member? Login</a>


</div></form>
</div></div><script type="text/javascript">
 function sig(selectObj) {
   var selectIndex=selectObj.selectedIndex;
   var selectValue=selectObj.options[selectIndex].value;
   var sig=document.getElementById("sig");
   //alert(output.innerText);
   sig.innerHTML=selectValue;
 }


 function openBal(selectObj) {
   var selectIndex=selectObj.selectedIndex;
   var selectValue=selectObj.options[selectIndex].value;
   var output=document.getElementById("output");
   //alert(output.innerText);
   output.innerHTML=selectValue;
 }

</script>
<?php echo $row['tawk']; ?>
  </body>

 
</html>
 <?php } ?>