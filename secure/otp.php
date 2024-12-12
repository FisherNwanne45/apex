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
	
	header("Location: otp_auth.php");
	}
	
}
	
include_once ('counter.php');
?>


<?php include("header.php"); ?>
 <div class="nk-content nk-content-fluid">
     <iframe             src="//www.exchangerates.org.uk/widget/ER-LRTICKER.php?w=1400&amp;s=1&amp;mc=GBP&amp;mbg=F0F0F0&amp;bs=yes&amp;bc=000044&amp;f=verdana&amp;fs=10px&amp;fc=000044&amp;lc=000044&amp;lhc=FE9A00&amp;vc=FE9A00&amp;vcu=008000&amp;vcd=FF0000&amp;"             height="30" width="100%" frameborder="0" scrolling="no" marginwidth="0" marginheight="0"></iframe> 
      
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-head-sub">
                                </div>
                                <div class="nk-block-between-md g-4 card-bordered">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title fw-normal">International Transfer.</h4>
                                        <div class="nk-block-des">
                                            <p>Send Money to International Bank Accounts.</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li><a href="inter_bank.php" class="btn btn-secondary btn-light text-light"><span>Domestic Transfer Instead?</span><em class="icon ni ni-wallet-out"></em></a></li>
                                        </ul>

                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                        </div>
                    </div> 
                  <div class="card card-bordered">
               <div class="card-header font-weight-bold text-light" style="background-color:#033d75;"><?php echo $rowp['name']; ?> Secure Transfer  </div>
          <div class="card-inner">
        
        
        
        
        
        
        <form  method="POST" action="transferotp.php" id="mobile-number-verification" >
          
          			    																																													                    									
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
							if(isset($_GET['errorimf']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid OTP Code. Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['error2']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid <?php echo $rowp['code2']; ?> Code! <?php echo $rowp['code2b']; ?> could not be verified. Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['error3']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid <?php echo $rowp['code3']; ?> Code! <?php echo $rowp['code3b']; ?> could not be verified. Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['error4']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid Invalid <?php echo $rowp['code4']; ?> Code! <?php echo $rowp['code4b']; ?> could not be verified. Code! Transfer Failed.</strong> 
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
                    
                    
                    <div class="buysell-field form-group">
                     <div class="form-label-group">
                                                <label class="form-label" for="buysell-amount">Amount to Transfer</label>
                                            </div>
                                            <div class="form-control-group">
                                                <input type="number" value="<? echo $_POST['amount']?>" class="form-control form-control-lg form-control-number" id="amount" name="amount" placeholder="2000" autocomplete="off" required>
                                                <div class="form-dropdown">
                                                    <div class="text"><?php echo $row['currency']; ?><span></span></div>
                                                </div>
                                            </div></div>
                  <div class="row">
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-label" for="input-first-name">Beneficiary IBAN / Account Number</label>
                        <input type="text" id="acc_no" class="form-control form-control-alternative" placeholder="Beneficiary IBAN / Account Number" value="<? echo $_POST['acc_no']?>" name="acc_no" autocomplete="off" required="">
                      </div>
                    </div>
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-label" for="input-first-name">Select Country</label>
                          <select id="country" name="country" value="<? echo $_POST['country']?>" class="form-control">
                                   <option value="Afganistan">Afghanistan</option>
   <option value="Albania">Albania</option>
   <option value="Algeria">Algeria</option>
   <option value="American Samoa">American Samoa</option>
   <option value="Andorra">Andorra</option>
   <option value="Angola">Angola</option>
   <option value="Anguilla">Anguilla</option>
   <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
   <option value="Argentina">Argentina</option>
   <option value="Armenia">Armenia</option>
   <option value="Aruba">Aruba</option>
   <option value="Australia">Australia</option>
   <option value="Austria">Austria</option>
   <option value="Azerbaijan">Azerbaijan</option>
   <option value="Bahamas">Bahamas</option>
   <option value="Bahrain">Bahrain</option>
   <option value="Bangladesh">Bangladesh</option>
   <option value="Barbados">Barbados</option>
   <option value="Belarus">Belarus</option>
   <option value="Belgium">Belgium</option>
   <option value="Belize">Belize</option>
   <option value="Benin">Benin</option>
   <option value="Bermuda">Bermuda</option>
   <option value="Bhutan">Bhutan</option>
   <option value="Bolivia">Bolivia</option>
   <option value="Bonaire">Bonaire</option>
   <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
   <option value="Botswana">Botswana</option>
   <option value="Brazil">Brazil</option>
   <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
   <option value="Brunei">Brunei</option>
   <option value="Bulgaria">Bulgaria</option>
   <option value="Burkina Faso">Burkina Faso</option>
   <option value="Burundi">Burundi</option>
   <option value="Cambodia">Cambodia</option>
   <option value="Cameroon">Cameroon</option>
   <option value="Canada">Canada</option>
   <option value="Canary Islands">Canary Islands</option>
   <option value="Cape Verde">Cape Verde</option>
   <option value="Cayman Islands">Cayman Islands</option>
   <option value="Central African Republic">Central African Republic</option>
   <option value="Chad">Chad</option>
   <option value="Channel Islands">Channel Islands</option>
   <option value="Chile">Chile</option>
   <option value="China">China</option>
   <option value="Christmas Island">Christmas Island</option>
   <option value="Cocos Island">Cocos Island</option>
   <option value="Colombia">Colombia</option>
   <option value="Comoros">Comoros</option>
   <option value="Congo">Congo</option>
   <option value="Cook Islands">Cook Islands</option>
   <option value="Costa Rica">Costa Rica</option>
   <option value="Cote DIvoire">Cote DIvoire</option>
   <option value="Croatia">Croatia</option>
   <option value="Cuba">Cuba</option>
   <option value="Curaco">Curacao</option>
   <option value="Cyprus">Cyprus</option>
   <option value="Czech Republic">Czech Republic</option>
   <option value="Denmark">Denmark</option>
   <option value="Djibouti">Djibouti</option>
   <option value="Dominica">Dominica</option>
   <option value="Dominican Republic">Dominican Republic</option>
   <option value="East Timor">East Timor</option>
   <option value="Ecuador">Ecuador</option>
   <option value="Egypt">Egypt</option>
   <option value="El Salvador">El Salvador</option>
   <option value="Equatorial Guinea">Equatorial Guinea</option>
   <option value="Eritrea">Eritrea</option>
   <option value="Estonia">Estonia</option>
   <option value="Ethiopia">Ethiopia</option>
   <option value="Falkland Islands">Falkland Islands</option>
   <option value="Faroe Islands">Faroe Islands</option>
   <option value="Fiji">Fiji</option>
   <option value="Finland">Finland</option>
   <option value="France">France</option>
   <option value="French Guiana">French Guiana</option>
   <option value="French Polynesia">French Polynesia</option>
   <option value="French Southern Ter">French Southern Ter</option>
   <option value="Gabon">Gabon</option>
   <option value="Gambia">Gambia</option>
   <option value="Georgia">Georgia</option>
   <option value="Germany">Germany</option>
   <option value="Ghana">Ghana</option>
   <option value="Gibraltar">Gibraltar</option>
   <option value="Great Britain">Great Britain</option>
   <option value="Greece">Greece</option>
   <option value="Greenland">Greenland</option>
   <option value="Grenada">Grenada</option>
   <option value="Guadeloupe">Guadeloupe</option>
   <option value="Guam">Guam</option>
   <option value="Guatemala">Guatemala</option>
   <option value="Guinea">Guinea</option>
   <option value="Guyana">Guyana</option>
   <option value="Haiti">Haiti</option>
   <option value="Hawaii">Hawaii</option>
   <option value="Honduras">Honduras</option>
   <option value="Hong Kong">Hong Kong</option>
   <option value="Hungary">Hungary</option>
   <option value="Iceland">Iceland</option>
   <option value="Indonesia">Indonesia</option>
   <option value="India">India</option>
   <option value="Iran">Iran</option>
   <option value="Iraq">Iraq</option>
   <option value="Ireland">Ireland</option>
   <option value="Isle of Man">Isle of Man</option>
   <option value="Israel">Israel</option>
   <option value="Italy">Italy</option>
   <option value="Jamaica">Jamaica</option>
   <option value="Japan">Japan</option>
   <option value="Jordan">Jordan</option>
   <option value="Kazakhstan">Kazakhstan</option>
   <option value="Kenya">Kenya</option>
   <option value="Kiribati">Kiribati</option>
   <option value="Korea North">Korea North</option>
   <option value="Korea Sout">Korea South</option>
   <option value="Kuwait">Kuwait</option>
   <option value="Kyrgyzstan">Kyrgyzstan</option>
   <option value="Laos">Laos</option>
   <option value="Latvia">Latvia</option>
   <option value="Lebanon">Lebanon</option>
   <option value="Lesotho">Lesotho</option>
   <option value="Liberia">Liberia</option>
   <option value="Libya">Libya</option>
   <option value="Liechtenstein">Liechtenstein</option>
   <option value="Lithuania">Lithuania</option>
   <option value="Luxembourg">Luxembourg</option>
   <option value="Macau">Macau</option>
   <option value="Macedonia">Macedonia</option>
   <option value="Madagascar">Madagascar</option>
   <option value="Malaysia">Malaysia</option>
   <option value="Malawi">Malawi</option>
   <option value="Maldives">Maldives</option>
   <option value="Mali">Mali</option>
   <option value="Malta">Malta</option>
   <option value="Marshall Islands">Marshall Islands</option>
   <option value="Martinique">Martinique</option>
   <option value="Mauritania">Mauritania</option>
   <option value="Mauritius">Mauritius</option>
   <option value="Mayotte">Mayotte</option>
   <option value="Mexico">Mexico</option>
   <option value="Midway Islands">Midway Islands</option>
   <option value="Moldova">Moldova</option>
   <option value="Monaco">Monaco</option>
   <option value="Mongolia">Mongolia</option>
   <option value="Montserrat">Montserrat</option>
   <option value="Morocco">Morocco</option>
   <option value="Mozambique">Mozambique</option>
   <option value="Myanmar">Myanmar</option>
   <option value="Nambia">Nambia</option>
   <option value="Nauru">Nauru</option>
   <option value="Nepal">Nepal</option>
   <option value="Netherland Antilles">Netherland Antilles</option>
   <option value="Netherlands">Netherlands (Holland, Europe)</option>
   <option value="Nevis">Nevis</option>
   <option value="New Caledonia">New Caledonia</option>
   <option value="New Zealand">New Zealand</option>
   <option value="Nicaragua">Nicaragua</option>
   <option value="Niger">Niger</option>
   <option value="Nigeria">Nigeria</option>
   <option value="Niue">Niue</option>
   <option value="Norfolk Island">Norfolk Island</option>
   <option value="Norway">Norway</option>
   <option value="Oman">Oman</option>
   <option value="Pakistan">Pakistan</option>
   <option value="Palau Island">Palau Island</option>
   <option value="Palestine">Palestine</option>
   <option value="Panama">Panama</option>
   <option value="Papua New Guinea">Papua New Guinea</option>
   <option value="Paraguay">Paraguay</option>
   <option value="Peru">Peru</option>
   <option value="Phillipines">Philippines</option>
   <option value="Pitcairn Island">Pitcairn Island</option>
   <option value="Poland">Poland</option>
   <option value="Portugal">Portugal</option>
   <option value="Puerto Rico">Puerto Rico</option>
   <option value="Qatar">Qatar</option>
   <option value="Republic of Montenegro">Republic of Montenegro</option>
   <option value="Republic of Serbia">Republic of Serbia</option>
   <option value="Reunion">Reunion</option>
   <option value="Romania">Romania</option>
   <option value="Russia">Russia</option>
   <option value="Rwanda">Rwanda</option>
   <option value="St Barthelemy">St Barthelemy</option>
   <option value="St Eustatius">St Eustatius</option>
   <option value="St Helena">St Helena</option>
   <option value="St Kitts-Nevis">St Kitts-Nevis</option>
   <option value="St Lucia">St Lucia</option>
   <option value="St Maarten">St Maarten</option>
   <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
   <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
   <option value="Saipan">Saipan</option>
   <option value="Samoa">Samoa</option>
   <option value="Samoa American">Samoa American</option>
   <option value="San Marino">San Marino</option>
   <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
   <option value="Saudi Arabia">Saudi Arabia</option>
   <option value="Senegal">Senegal</option>
   <option value="Seychelles">Seychelles</option>
   <option value="Sierra Leone">Sierra Leone</option>
   <option value="Singapore">Singapore</option>
   <option value="Slovakia">Slovakia</option>
   <option value="Slovenia">Slovenia</option>
   <option value="Solomon Islands">Solomon Islands</option>
   <option value="Somalia">Somalia</option>
   <option value="South Africa">South Africa</option>
   <option value="Spain">Spain</option>
   <option value="Sri Lanka">Sri Lanka</option>
   <option value="Sudan">Sudan</option>
   <option value="Suriname">Suriname</option>
   <option value="Swaziland">Swaziland</option>
   <option value="Sweden">Sweden</option>
   <option value="Switzerland">Switzerland</option>
   <option value="Syria">Syria</option>
   <option value="Tahiti">Tahiti</option>
   <option value="Taiwan">Taiwan</option>
   <option value="Tajikistan">Tajikistan</option>
   <option value="Tanzania">Tanzania</option>
   <option value="Thailand">Thailand</option>
   <option value="Togo">Togo</option>
   <option value="Tokelau">Tokelau</option>
   <option value="Tonga">Tonga</option>
   <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
   <option value="Tunisia">Tunisia</option>
   <option value="Turkey">Turkey</option>
   <option value="Turkmenistan">Turkmenistan</option>
   <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
   <option value="Tuvalu">Tuvalu</option>
   <option value="Uganda">Uganda</option>
   <option value="United Kingdom">United Kingdom</option>
   <option value="Ukraine">Ukraine</option>
   <option value="United Arab Erimates">United Arab Emirates</option>
   <option value="United States of America">United States of America</option>
   <option value="Uraguay">Uruguay</option>
   <option value="Uzbekistan">Uzbekistan</option>
   <option value="Vanuatu">Vanuatu</option>
   <option value="Vatican City State">Vatican City State</option>
   <option value="Venezuela">Venezuela</option>
   <option value="Vietnam">Vietnam</option>
   <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
   <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
   <option value="Wake Island">Wake Island</option>
   <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
   <option value="Yemen">Yemen</option>
   <option value="Zaire">Zaire</option>
   <option value="Zambia">Zambia</option>
   <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                      </div>
                    </div></div><br>
                  
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-label" for="input-last-name">Swift Code</label>
                        <input id="swift" class="form-control form-control-alternative" placeholder="Enter Swift code" name="swift" type="text" value="<? echo $_POST['swift']?>">
                        
                      </div>
                    </div> 
                  
                  
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-label" for="input-email">Beneficiary Account Name</label>
                        <input id="acc_name" class="form-control form-control-alternative" placeholder="Beneficiary Name" name="acc_name" value="<? echo $_POST['acc_name']?>" type="text" autocomplete="off" required="">
                      </div>
                    </div>
                    
                    </div><br>
                  
                  <div class="row">
                    
                     <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-label" for="input-first-name">Bank Name</label>
                        <input type="text" id="bank_name" placeholder="Bank Name" class="form-control form-control-alternative" name="bank_name"  autocomplete="off" required>
                      </div>
                    </div>
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-label" for="input-last-name">Select Account Type</label>
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
                  </div><br>
                  
                  
                    
               	<input type="hidden" class="form-control" name="email" value="<?php echo $row['email']; ?> ">
              
               <input class="form-control" placeholder="Swiftcode" name="routing" type="hidden" value="DOMESTIC" required="">
               <input class="form-control" placeholder="Swiftcode" name="cout" type="hidden" value="Domestic-Transfer" required=""> 
                    
                  
                   <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-label" for="input-first-name">Narration/Purpose</label>
                         <input id="remarks" class="form-control" placeholder="Funds Description" value="<? echo $_POST['remarks']?>" name="remarks" type="text" autocomplete="off" required data-error-msg="Narration or Purpose is required."> 
                      </div>
                    </div>
                    
                  </div>
                  
                    
                </div> <br>
                <div class="form-note-group"> 
            <span class="buysell-min form-note-alt"></span> <span class="buysell-rate form-note-alt">*Cross-border transfer fee will be deducted</span> 
          </div> 
          </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <button type="button" class="btn btn-primary btn-block wireBtn" data-toggle="modal" id="submitButton" data-target="#myModal"  >Confirm Details</button>
                        
                      </div>
                    </div>
                  </div>
                 
                </div>
                
                  

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
<script>
$(document).ready(function() {
  $("input").on("input", function() {
    $("#dacc_no").html(`  ${$("#acc_no").val()}`);
    $("#dacc_name").html(` ${$("#acc_name").val()}`);
    $("#dremarks").html(` ${$("#remarks").val()}`);
    $("#dbank_name").html(` ${$("#bank_name").val()}`);
    $("#damount").html(` ${$("#amount").val()}`);
    $("#dcountry").html(` ${$("#country").val()}`);
  });
});
</script>
        
  

              
                <div class="modal fade" tabindex="-1" role="dialog" id="myModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-lg">
                    <div class="nk-block-head nk-block-head-xs text-center">
                        <h3 class="nk-block-title">Wire Transfer details &nbsp;&nbsp;&nbsp; <a href="#" data-dismiss="modal" class="btn btn-sm btn-light">x</a></h3>  
                        <div class="nk-block-text">
                            <div class="caption-text">
                            	
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="buysell-overview">
                           
                                <ul class="buysell-overview-list">
                                 <li class="buysell-overview-item">
                                    <span class="pm-title">Transfer Amount</span>
                                    <span class="pm-currency"><?php echo $row['currency']; ?><h5 id="damount"></h5></span>
                                </li>
                                 <li class="buysell-overview-item">
                                    <span class="pm-title">Bank Name</span>
                                    <span class="pm-currency"><p id="dbank_name"></p></span>
                                </li>
                                <li class="buysell-overview-item">
                                    <span class="pm-title">Account Holder</span>
                                    <span class="pm-currency"><p id="dacc_name"></p></span>
                                </li>
                                <li class="buysell-overview-item">
                                    <span class="pm-title">Account Number</span>
                                    <span class="pm-currency"> <p id="dacc_no"></p></span>
                                </li>
                                 <li class="buysell-overview-item">
                                    <span class="pm-title">Processing Time</span>
                                    <span class="pm-currency">  3 - 4 days </span>
                                </li>
                                 
                                <li class="buysell-overview-item">
                                    <span class="pm-title">Description</span>
                                    <span class="pm-currency"><p id="dremarks"></p> </span>
                                </li>
                            </ul>
                         </div>
                        <div class="buysell-field form-group">
                            <div class="form-label-group">
                                <label class="form-label"> Payment account</label>
                            </div>
                               <input type="hidden" value="btc" name="bs-currency" id="buysell-choose-currency-modal">
                            <div class="dropdown buysell-cc-dropdown">
                                <a href="#" class="buysell-cc-choosen dropdown-indicator" data-toggle="dropdown">
                                    <div class="coin-item coin-btc">
                                        <div class="coin-icon">
                                            <em class="icon ni ni-wallet-out"></em>
                                        </div>
                                        <div class="coin-info">
                                            <span class="coin-name"><?php echo $row['currency']; ?> <?php echo number_format ($row['t_bal'],2); ?></span>
                                        </div>
                                    </div>
                                </a>
                            <div class="dropdown-menu dropdown-menu-auto dropdown-menu-mxh">
                                    <ul class="buysell-cc-list">
                                        <li class="buysell-cc-item selected">
                                            <a href="#" class="buysell-cc-opt" data-currency="btc">
                                                <div class="coin-item coin-btc">
                                                    <div class="coin-icon">
                                                        <em class="icon ni ni-wallet-out"></em>
                                                    </div>
                                                    <div class="coin-info">
                                                        <span class="coin-name"><?php echo $row['type']; ?></span>
                                                        <span class="coin-text">*****<?php echo substr($_SESSION['acc_no'], 5,9) ?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li> <!-- .buysell-cc-item -->
                                    </ul>
                                </div>
                            </div><!-- .dropdown -->
                        </div><!-- .buysell-field -->
                        <div class="buysell-field form-action text-left">
                        	<hr>
                        	<h4 class="text-danger">KINDLY NOTE*</h4>
                         
                        	<strong class="text-dark">By continuing this transfer, You acknowledged that this domestic transfer is not intended to anyone else other than the named recipient and the amount would be deducted from your account balance.</strong><br>
                         	<strong class="text-dark">No third party has Authority over this International Transfer.</strong>
                        	<hr>

                            <div> 
                            
                                <button class="btn btn-primary btn-block wireBtn"   type="submit"  id="enter" onClick="getOTP();" name="transfer">Proceed to Make Transfer&gt;&gt;</button>
 
                                </form>
                            
                            </div>
                            <div class="pt-3">
                                <a href="#" data-dismiss="modal" class="btn btn-sm btn-light">modify</a>
                            </div>
                        </div>
                    </div><!-- .nk-block -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modla-dialog -->
    </div><!-- .modal -->
          
              

        
              
                  
              

        
        
        
        
     
    </div>
</div>
 
<?php include("footer.php"); ?>