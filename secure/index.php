<?php
session_start();
include_once ('session.php');
require_once('geo/geoplugin.class.php');

$geoplugin = new geoPlugin();
$geoplugin->locate();
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

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$site = $row['site'];

$stct = $reg_user->runQuery("SELECT * FROM site WHERE id = '20'");
$stct->execute(array(":acc_no"=>$_SESSION['acc_no']));
$rowp = $stct->fetch(PDO::FETCH_ASSOC);

$email = $row['email'];

$temp = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email' ORDER BY id DESC LIMIT 1");
$temp->execute(array(":acc_no"=>$_SESSION['acc_no']));
$rows = $temp->fetch(PDO::FETCH_ASSOC);

include_once ('counter.php');
?>


<?php include("header.php"); ?>

   <!-- content @s -->
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        
                        <div class="nk-content-body"><?php 
							if(isset($_GET['dormant']))
								{
									?><br>
									<div class='alert alert-warning'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Sorry, your account is dormant/inactive, please contact customer care at <a href="mailto:<?php echo $rowp['email']; ?>"><?php echo $rowp['email']; ?></a>&nbsp; for further information.</strong> 
									</div>
									<?php
								}
						?>
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
                                            <p>At a glance summary of your account!</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li><a href="profile.php" class="btn btn-primary"><span>Account</span> <em class="icon ni ni-arrow-long-right"></em></a></li>
                                            <li><a href="wire.php" class="btn btn-secondary btn-light text-light"><span>Transfer Fund</span> <em class="icon ni ni-arrow-long-right d-none d-sm-inline-block"></em></a></li>
                                        </ul>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="row gy-gs">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="nk-block">
                                            <div class="nk-block-head-xs">
                                                <div class="nk-block-head-content">
                                                    <h5 class="nk-block-title title">Overview</h5>
                                                </div>
                                            </div><!-- .nk-block-head -->
                                            <div class="nk-block">
                                                <div class="card card-bordered text-light is-dark h-100">
                                                    <div class="card-inner">
                                                        <div class="nk-wg7">
                                                            <div class="nk-wg7-stats-group">
                                                            	<div class="nk-wg7-stats w-50" style="border-color: white; border-width: 5px; border-radius: 50%;">
                                                                    
                                                               <img src="admin/foto/<?php echo $row['pp']; ?>" alt="profile" width="85" style="border-color: white; border-width: 5px; border-radius:50px;" height="85"> 
                                                               
                                                                
                                                           
                                                            </div>
                                                            <div class="nk-wg7-stats w-70">
                                                                <div class="nk-wg7-title">Available balance</div>
                                                                <div class="number-lg amount"><?php echo $row['currency']; ?><?php echo number_format ($row['t_bal'],2); ?></div>
                                                               <?php echo $row['fname']; ?> <?php echo $row['lname']; ?>
                                                            </div> 
                                                            </div>
                                                            <div class="nk-wg7-stats-group">
                                                                <div class="nk-wg7-stats w-70">
                                                                    <div class="nk-wg7-title">Account Status</div>
                                                                    <div class="  ">
           <?php
 
   
$stat = $row['status'];

if($stat == "Active" || $stat == "pincode" || $stat == "otp")
{
echo '<span class="text-success ml-2">Active </span>  ';
} elseif($stat == "Dormant/Inactive") {    echo ' <span class="text-danger ml-2"> Inactive  </span> ';
               
        }
else {    echo $row['status'];
               
        }
?>
           </div>
                                                                </div>
                                                                <div class="nk-wg7-stats w-50"> 
                                                                  
                                                                   
                                                                </div>
                                                            </div>
                                                        </div><!-- .nk-wg7 -->
                                                    </div><!-- .card-inner -->
                                                </div><!-- .card -->
                                            </div><!-- .nk-block -->
                                        </div><!-- .nk-block -->
                                    </div><!-- .col -->
                                     <div class="col-lg-6 col-xl-6">
                                        <div class="nk-block">
                                            <div class="nk-block-head-xs">
                                                <div class="nk-block-between-md g-2">
                                                    <div class="nk-block-head-content">
                                                        <h5 class="nk-block-title title">Account Type: <?php echo $row['type']; ?> </h5>
                                                    </div>
                                                    <div class="nk-block-head-content">
                                                        <a href="transfer.php" class="link link-primary">Transfer Fund</a>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-block-head -->
                                            <div class="row g-2">
                                                <div class="col-sm-12">
                                                    <div class="card bg-light">
                                                        <div class="nk-wgw sm">
                                                            <a class="nk-wgw-inner" href="#">
                                                                <div class="nk-wgw-name">
                                                                    <div class="nk-wgw-icon">
                                                                        <em class="icon ni ni-sign-cc-alt"></em>       </div>
                                                                    <h5 class="nk-wgw-title title">*****<?php echo substr($_SESSION['acc_no'], 5,9) ?></h5>
                                                                </div>
                                                                <div class="nk-wgw-balance">
                                                                    <div class="amount">
                                                                      <span class="currency currency-nio">  <?php echo $row['currency']; ?></span><?php echo number_format ($row['t_bal'],2); ?>
                                                                        
                                                      </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div><!-- .col -->
                                            </div><!-- .row -->
                                        </div><!-- .nk-block -->
                                        <div class="nk-block nk-block-md">
                                            <div class="nk-block-head-xs">
                                                <div class="nk-block-between-md g-2">
                                                    <div class="nk-block-head-content">
                                                        <h6 class="nk-block-title title">Loans and lines of credit</h6>
                                                    </div>
                                                    <div class="nk-block-head-content">
                                                        <a href="loan.php" class="link link-primary">Apply for Loan</a>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-block-head -->
                                            <div class="row g-2">
                                                <div class="col-sm-6">
                                                    <div class="card bg-light">
                                                        <div class="nk-wgw sm">
                                                            <a class="nk-wgw-inner" href="loan.php">
                                                                <div class="nk-wgw-name">
                                                                    <div class="nk-wgw-icon">
                                                                        <em class="icon ni ni-check-circle"></em>
                                                                    </div>
                                                                    <h5 class="nk-wgw-title title">Business Support Loan</h5>
                                                                </div>
                                                                <div class="nk-wgw-balance">
                                                                    <div class="amount">
                                                                    
                                                                    
                                                                    
                                                                    <span class="currency currency-nio">
                                                                    
                                                                    <?php
 
   
$lodu = $row['lodur'];

if($lodu == "")
{
echo ' <span class="currency currency-nio"> NO LOAN APPROVED  </span>  ';
} else {    echo

$row['currency']; $row['loan']; '<br>';

$row['lodur'];
               
        }

?>
                                                                    </span></div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div><!-- .col -->
                                             
                                                <div class="col-sm-6">
                                                    <div class="card bg-light">
                                                        <div class="nk-wgw sm">
                                                            <a class="nk-wgw-inner" href="card.php">
                                                                <div class="nk-wgw-name">
                                                                    <div class="nk-wgw-icon">
                                                                        <em class="icon ni ni-sign-cc-alt2"></em>
                                                                    </div>
                                                                    <h5 class="nk-wgw-title title">Account Cards</h5>
                                                                </div>
                                                                <div class="nk-wgw-balance">
                                                                    <div class="amount text-dark"><?php
 
   
$ccdt = $row['ccdate'];

if($ccdt == "")
{
echo ' <span class="currency currency-nio"> No Card. Apply Now! </span>     ';
} else {   echo 'Expires'; echo  $row['ccdate'];
               
        }

?></div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div><!-- .col -->
                                            </div><!-- .row -->
                                        </div> <!-- .nk-block -->
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div><!-- .nk-block -->
                            <div class="nk-block nk-block-lg">
                                <div class="row gy-gs">
                                    <div class="col-md-6">
                                        <div class="card-head">
                                            <div class="card-title  mb-0">
                                                <h5 class="title">Recent Transaction Activities</h5>
                                            </div>
                                            <div class="card-tools">
                                                <ul class="card-tools-nav">
                                                    <li class="active"><a href="statement.php">All</a></li>
                                                </ul>
                                            </div>
                                        </div><!-- .card-head -->
                                        <div class="tranx-list card card-bordered">
                                            
                                             
                   <?php 
					$acc_no = $_SESSION['acc_no'];
				$email = $row['email'];
				$his = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email' order by date desc  LIMIT 2");
				$his->execute(array(":acc_no"=>$_SESSION['acc_no']));
				while($rows = $his->fetch(PDO::FETCH_ASSOC)){?>
              
               <?php $type = $rows['type'];
                                             if ($type == "Debit") {
                                             $ico = 'wallet-out';
                                             $color = 'text-danger';
                                             $sign = '-';
                                             $to = 'from';
                                             $holder = 'Receiver';
                                             }
                                             else{
                                                $ico = 'wallet-in';
                                                $color = 'text-danger';
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
                                                            <div class="text-primary">Transfer</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tranx-col">
                                                    <div class="tranx-amount">
                                                        <div class="tranx-date">Amount</div>
                                               <div class="<?php echo$color ?> fs-16px">  - <?php echo $rows['amount']; ?>
                                                 <span class="currency currency-usd"><span class="currency currency-btc"><?php echo $row['currency']; ?></span></div>
                                                        <div class="number-sm"><?php echo "$to"; ?> <?php echo $rows['acc_name']; ?></div>
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
            <div class="modal-content text-center"><br><a><img class="logo-dark logo-img" src="img/logo.png" height="50px" alt="logo-dark"></a><br>
                 <div class="card-header receipt font-weight-bold " style="font-size: 25px;  "> <?php echo $rowp['name']; ?> </div>
                <div class="modal-header bg-primary text-light">
                    <p class="modal-title text-light receipt" style="font-size: 14px; background-color:#033d75; " >Transaction Receipt</p>
                    <a href="#" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                      <ul class="buysell-overview-list">
                                <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Amount Transferred</span></span>
                                    <span class="pm-title"><?php echo $row['currency']; ?><?php echo $rows['amount']; ?></span>
                                </li>
                                
                                
                                <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span><?php echo"$holder"; ?>:</span></span>
                                    <span class="pm-title">  <?php echo $rows['acc_name']; ?></span>
                                </li>
                                
                                <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Account Number:</span></span>
                                    <span class="pm-title"> <?php echo $rows['acc_no']; ?>  </span>
                                </li>
                                
                                
                                <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Bank Name:</span></span>
                                    <span class="pm-title"> <?php echo $rows['bank_name']; ?>  </span>
                                </li>

 <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Date:</span></span>
                                    <span class="pm-title"> <?php echo $rows['date']; ?>  </span>
                                </li>
                                
                            </ul>
                            
                            <br> <div class="hide-on-print">
                            <button onclick="printDiv('modalDefault<?php echo $rows['id']; ?>')" class="btn btn-sm btn-mw btn-primary hide-on-print"><span>Print Receipt</span><em class="icon ni ni-printer"></em></button>
                            
                             <a href="index.php" class="btn btn-sm btn-mw btn-danger"><span>Back</span><em class="icon ni ni-arrow-long-left"></em></a></div>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text text-primary">Proccessed by <?php echo $rowp['name']; ?> Digital banking services.</span>
                </div>
            </div>
        </div>
    </div>
              
              
              
              
              
              
              
              
              <?php } ?>
              
              
              
              
                   <?php 
				$acc_no = $_SESSION['acc_no'];
			
			 
                                             $id = $rows['id'];
                                             
                                     
                                             
                                             
                                             
				$debcre = $reg_user->runQuery("SELECT * FROM alerts WHERE uname = '$acc_no' order by id desc  LIMIT 2");
				$debcre->execute();
				while($rows = $debcre->fetch(PDO::FETCH_ASSOC)){?>
              
               <?php $type = $rows['type'];
                                             if ($type == "Debit") {
                                             $ico = 'wallet-out';
                                             $color = 'text-danger';
                                             $sign = '-';
                                             $to = 'to';
                                             $holder = 'Receiver';
                                             }
                                             else{
                                                $ico = 'wallet-in';
                                                $color = 'text-success';
                                                $sign = '+';
                                                $to = 'from';
                                                $holder = 'Sender';
                                             }
              ?>
              
              
               <div class="tranx-item">
                                                <div class="tranx-col">
                                                    <div class="tranx-info">
                                                        <div class="tranx-data">
                                                            <div class="tranx-label"><?php echo "$uname"; ?><em class="tranx-icon sm icon ni ni-<?php echo "$ico"; ?>"></em></div>
                                                            <div class="tranx-date"><?php echo $dated?></div>
                                                            <div class="text-primary"><?php echo $rows['type']; ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tranx-col">
                                                    <div class="tranx-amount">
                                                        <div class="tranx-date">Amount</div>
                                               <div class="<?php echo$color ?> fs-16px"><?php echo"$sign " ?> <?php echo $rows['amount']; ?>
                                                 <span class="currency currency-usd"><span class="currency currency-btc"><?php echo $row['currency']; ?></span></div>
                                                        <div class="number-sm"><?php echo "$to"; ?> <?php echo $rows['sender_name']; ?></div>
                                                    </div>
                                                </div>
                                                 <div class="tranx-col">
                                                    <div class="tranx-amount">
                                                        <div class="number-sm">Successful <span class="currency currency-btc"></span></div>
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
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Amount <?php echo $rows['type']; ?>ed</span></span>
                                    <span class="pm-title"><?php echo $row['currency']; ?><?php echo $rows['amount']; ?></span>
                                </li>
                                 <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Transaction Description:</span></span>
                                    <span class="pm-title"><?php echo $rows['remarks']; ?></span>
                                </li>
                                
                                
                                <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span><?php echo"$holder"; ?>:</span></span>
                                    <span class="pm-title"><?php echo $rows['sender_name']; ?></span>
                                </li>

                                
                            </ul>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text text-primary">Proccessed by <?php echo $rowp['name']; ?> Digital banking services.</span>
                </div>
            </div>
        </div>
    </div>
              
              
              
              
              
              
              
              <?php } ?>
            
                                            
                                            
                                            
                                            
                                            
                                                           
                                        <!-- .tranx-list -->
                                    </div></div><!-- .col -->
                                    <div class="col-md-6">
                                       <!-- .card-title -->
                                       <!-- .card -->
                                        <p></p>
<div class="tradingview-widget-container" style="width: 100%;">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/EURUSD/?exchange=FX" rel="noopener" target="_blank"><span class="blue-text">EURUSD Rates</span></a></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
  {
  "symbol": "FX:EURUSD",
  "width": 450 ,
  "height": 400,
  "locale": "en",
  "dateRange": "12M",
  "colorTheme": "dark",
  "trendLineColor": "rgba(41, 98, 255, 1)",
  "underLineColor": "rgba(41, 98, 255, 0.3)",
  "underLineBottomColor": "rgba(41, 98, 255, 0)",
  "isTransparent": false,
  "autosize": true,
  "largeChartUrl": ""
}
  </script>
</div>
<!-- TradingView Widget END -->
                      </div><!-- .col -->
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
                <script>
function printDiv(divName) {
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;

  document.body.innerHTML = printContents;

  window.print();

  document.body.innerHTML = originalContents;
}
</script> 
<style type="text/css" media="print">
  .hide-on-print {
    display: none !important;
  }
</style>
                <?php  include("footer.php");?>