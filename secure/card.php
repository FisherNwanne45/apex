<?php session_start();
include_once ('session.php');
require_once ('class.user.php');
if(!isset($_SESSION['acc_no'])){
header("Location: login.php");
exit();
}

elseif(!isset($_SESSION['mname'])){
    
header("Location: passcode.php");
exit(); 
}
$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$site = $row['site'];

$stct = $reg_user->runQuery("SELECT * FROM site WHERE id = '20'");
$stct->execute(array(":acc_no"=>$_SESSION['acc_no']));
$rowp = $stct->fetch(PDO::FETCH_ASSOC);

include_once ('counter.php');?>
<?php include("header.php"); ?>

   <!-- content @s -->
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-head-sub">
                                </div>
                                <div class="nk-block-between-md g-4 card-bordered">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title fw-normal"> <?php
    /* This sets the $time variable to the current hour in the 24 hour clock format */
    $time = date("H");
    /* Set the $timezone variable to become the current timezone */
    $timezone = date("e");
    /* If the time is less than 1200 hours, show good morning */
    if ($time < "12") {
        echo "Good Morning";
    } else
    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
    if ($time >= "12" && $time < "17") {
        echo "Good Afternoon";
    } else
    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
    if ($time >= "17" && $time < "19") {
        echo "Good Evening";
    } else
    /* Finally, show good night if the time is greater than or equal to 1900 hours */
    if ($time >= "19") {
        echo "Good Night";
    }
    ?> <?php echo $row['fname']; ?> <?php echo $row['lname']; ?></h4>
                                        <div class="nk-block-des">
                                            <p>At a glance summary of your Loan Applications!</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li><a href="cardapply.php" class="btn btn-primary"><span>Apply for New Card</span> <em class="icon ni ni-arrow-long-right"></em></a></li>
                                            <li><a href="profile.php" class="btn btn-secondary btn-light text-light"><span>Preferences</span> <em class="icon ni ni-arrow-long-right d-none d-sm-inline-block"></em></a></li>
                                        </ul>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                             <div class="nk-block nk-block-lg">
                                <div class="row gy-gs">
                                    <div class="col-md-12">
                                        <div class="card-head">
                                            <div class="card-title  mb-0">
                                                <h5 class="title">Recent Transaction Activities</h5>
                                            </div>
                                            <div class="card-tools">
                                                <ul class="card-tools-nav">
                                                    <li class="active"><a href="#">All</a></li>
                                                </ul>
                                            </div>
                                        </div><!-- .card-head -->
                                        <div class="tranx-list card card-bordered">
                                            
                                             
                   <?php 
					 
                                             if ($type == "Debit") {
                                             $ico = 'wallet-out';
                                             $color = 'text-danger';
                                             $sign = '-';
                                             $to = 'from';
                                             $holder = 'Receiver';
                                             }
                                             else{
                                                $ico = 'wallet-in';
                                                $color = 'text-success';
                                                $sign = '+';
                                                $to = 'to';
                                                $holder = 'Receiver';
                                             }
              ?>
              
              
               <div class="tranx-item">
                                                <div class="tranx-col">
                                                    <div class="tranx-info">
                                                        <div class="tranx-data">
                                                            <div class="tranx-label"><?php echo "$uname"; ?><em class="tranx-icon sm icon ni ni-<?php echo "$ico"; ?>"></em></div>
                                                            <div class="tranx-date"><?php echo $dated?></div>
                                                            <div class="text-primary">CVV: <?php
 
   
$ccv = $row['cvv'];

if($ccv == "")
{
echo '  123   ';
} else {    echo $row['cvv'];
               
        }

?>  </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tranx-col">
                                                    <div class="tranx-amount">
                                                        <div class="tranx-date">Card Number</div>
                                               <div class="<?php echo$color ?> fs-16px">   
                                               
                                               
                                              <?php
 
   
$cc = $row['ccard'];

if($cc == "")
{
echo '  XXXAPPLY NOW-XXXX    ';
} else {    echo $row['ccard'];
               
        }

?> 
                                                  </div>
                                                        <div class="number-sm">Expires: <?php
 
   
$ccdt = $row['ccdate'];

if($ccdt == "")
{
echo '  DD/YY   ';
} else {    echo $row['ccdate'];
               
        }

?></div>
                                                    </div>
                                                </div>
                                                 <div class="tranx-col">
                                                    <div class="tranx-amount">
                                                        <div class="number-sm"><?php echo $rows['status']; ?> <span class="currency currency-btc"></span></div>
                                                        <span class="badge badge-dim badge-pill badge-outline-primary" data-toggle="modal" data-target="#modalDefault<?php echo $rows['id']; ?> ">View Details</span>
                                              </div>
                                      </div>
                             </div><!-- .tranx-item -->
              
              
              
               <div class="modal fade" tabindex="-1" id="modalDefault<?php echo $rows['id']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title text-light">Transaction Details</h5>
                    <a href="#" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                      <ul class="buysell-overview-list">
                                <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Card Number</span></span>
                                    <span class="pm-title"><?php
 
   
$cc = $row['ccard'];

if($cc == "")
{
echo '  XXXAPPLY NOW-XXXX    ';
} else {    echo $row['ccard'];
               
        }

?>  </span>
                                </li>
                                 <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Expiration Date:</span></span>
                                    <span class="pm-title"><?php
 
   
$ccdt = $row['ccdate'];

if($ccdt == "")
{
echo '  DD/YY   ';
} else {    echo $row['ccdate'];
               
        }

?></span>
                                </li>
                                
                                
                                
                                
                                <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>CVV:</span></span>
                                    <span class="pm-title"> <?php
 
   
$ccv = $row['cvv'];

if($ccv == "")
{
echo '  123   ';
} else {    echo $row['cvv'];
               
        }

?> </span>
                                </li>
                                
                               
                                
                            </ul>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text text-primary">Proccessed by <?php echo $rowp['name']; ?> Digital banking services.</span>
                </div>
            </div>
        </div>
    </div>
              
              
             
                                            
                                            
                                            
                                            
                                                           
                                        <!-- .tranx-list -->
                                    </div></div><!-- .col -->
                                     
                                </div><!-- .row -->
                            </div><!-- .nk-block -->
                            <div class="nk-block">
                                <div class="card card-bordered">
                                    <div class="card-inner card-inner-lg">
                                        <div class="align-center flex-wrap flex-md-nowrap g-4">
                                            <div class="nk-block-image w-120px flex-shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 118">
                                                    <path d="M8.916,94.745C-.318,79.153-2.164,58.569,2.382,40.578,7.155,21.69,19.045,9.451,35.162,4.32,46.609.676,58.716.331,70.456,1.845,84.683,3.68,99.57,8.694,108.892,21.408c10.03,13.679,12.071,34.71,10.747,52.054-1.173,15.359-7.441,27.489-19.231,34.494-10.689,6.351-22.92,8.733-34.715,10.331-16.181,2.192-34.195-.336-47.6-12.281A47.243,47.243,0,0,1,8.916,94.745Z" transform="translate(0 -1)" fill="#f6faff" />
                                                    <rect x="18" y="32" width="84" height="50" rx="4" ry="4" fill="#fff" />
                                                    <rect x="26" y="44" width="20" height="12" rx="1" ry="1" fill="#e5effe" />
                                                    <rect x="50" y="44" width="20" height="12" rx="1" ry="1" fill="#e5effe" />
                                                    <rect x="74" y="44" width="20" height="12" rx="1" ry="1" fill="#e5effe" />
                                                    <rect x="38" y="60" width="20" height="12" rx="1" ry="1" fill="#e5effe" />
                                                    <rect x="62" y="60" width="20" height="12" rx="1" ry="1" fill="#e5effe" />
                                                    <path d="M98,32H22a5.006,5.006,0,0,0-5,5V79a5.006,5.006,0,0,0,5,5H52v8H45a2,2,0,0,0-2,2v4a2,2,0,0,0,2,2H73a2,2,0,0,0,2-2V94a2,2,0,0,0-2-2H66V84H98a5.006,5.006,0,0,0,5-5V37A5.006,5.006,0,0,0,98,32ZM73,94v4H45V94Zm-9-2H54V84H64Zm37-13a3,3,0,0,1-3,3H22a3,3,0,0,1-3-3V37a3,3,0,0,1,3-3H98a3,3,0,0,1,3,3Z" transform="translate(0 -1)" fill="#798bff" />
                                                    <path d="M61.444,41H40.111L33,48.143V19.7A3.632,3.632,0,0,1,36.556,16H61.444A3.632,3.632,0,0,1,65,19.7V37.3A3.632,3.632,0,0,1,61.444,41Z" transform="translate(0 -1)" fill="#6576ff" />
                                                    <path d="M61.444,41H40.111L33,48.143V19.7A3.632,3.632,0,0,1,36.556,16H61.444A3.632,3.632,0,0,1,65,19.7V37.3A3.632,3.632,0,0,1,61.444,41Z" transform="translate(0 -1)" fill="none" stroke="#6576ff" stroke-miterlimit="10" stroke-width="2" />
                                                    <line x1="40" y1="22" x2="57" y2="22" fill="none" stroke="#fffffe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                    <line x1="40" y1="27" x2="57" y2="27" fill="none" stroke="#fffffe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                    <line x1="40" y1="32" x2="50" y2="32" fill="none" stroke="#fffffe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                    <line x1="30.5" y1="87.5" x2="30.5" y2="91.5" fill="none" stroke="#9cabff" stroke-linecap="round" stroke-linejoin="round" />
                                                    <line x1="28.5" y1="89.5" x2="32.5" y2="89.5" fill="none" stroke="#9cabff" stroke-linecap="round" stroke-linejoin="round" />
                                                    <line x1="79.5" y1="22.5" x2="79.5" y2="26.5" fill="none" stroke="#9cabff" stroke-linecap="round" stroke-linejoin="round" />
                                                    <line x1="77.5" y1="24.5" x2="81.5" y2="24.5" fill="none" stroke="#9cabff" stroke-linecap="round" stroke-linejoin="round" />
                                                    <circle cx="90.5" cy="97.5" r="3" fill="none" stroke="#9cabff" stroke-miterlimit="10" />
                                                    <circle cx="24" cy="23" r="2.5" fill="none" stroke="#9cabff" stroke-miterlimit="10" /></svg>
                                            </div>
                                            <div class="nk-block-content">
                                                <div class="nk-block-content-head px-lg-4">
                                                    <h5>We’re here to help you!</h5>
                                                    <p class="text-soft">Ask a question or file a support ticket, manage request, report an issues. Our team support team will get back to you by email.</p>
                                                </div>
                                            </div>
                                            <div class="nk-block-content flex-shrink-0">
                                                <a href="ticket.php" class="btn btn-lg btn-outline-primary">Get Support Now</a>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
        
                <?php  include("footer.php");?>