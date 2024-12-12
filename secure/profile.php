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
<div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <div class="nk-block-head-sub"><span>Account Setting</span></div>
                                    <h2 class="nk-block-title fw-normal">My Profile</h2>
                                    <div class="nk-block-des">
                                        <p>You have full control to manage your own account setting. <span class="text-primary"><em class="icon ni ni-info" data-toggle="tooltip" data-placement="right" title="Update your password and pin from the security section"></em></span></p>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <ul class="nk-nav nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="profile">Personal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#security">Security</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="ticket.php">Support Ticket</a>
                                </li>
                            </ul><!-- .nk-menu -->
                            <!-- NK-Block @s -->
                            <div class="nk-block">
                                <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-head-sub">
                                </div>
                                <div class="nk-block-between-md g-4 card-bordered">
                                    
                                        
                                        
                                        <div class="col-lg-6 col-xl-6">
                                         <div class="alert alert-warning">
                                     
                                        <div class="alert-text">
                                            <p>When you're on public Wi-Fi, hackers can more easily access your computer and steal personal information from it. You should never access your online banking through a computer, tablet, or mobile phone unless you're on a secure Wi-Fi network with a password, or using your own cell phone data connection. This is much more difficult for thieves to hack, so it keeps your information safer.</p>
                                        </div>
                                   
                                </div><!-- .alert -->
                                        
                                         
                                    
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li>  <img src="admin/foto/<?php echo $row['image']; ?>"style="max-height: 250px; width: auto;" ></li>
                                        </ul>

                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                        </div>
                    </div>
                    
                               
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Personal Information</h5>
                                        <div class="nk-block-des">
                                            <p>Basic info, like your name and address, that you using on <?php echo $rowp['name']; ?>.</p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                
                                <div class="nk-data data-list">
                                    <div class="data-head">
                                        <h6 class="overline-title">Basics</h6>
                                    </div>
                                    <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                        <div class="data-col">
                                            <span class="data-label">Full Name</span>
                                            <span class="data-value"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?> </span>
                                        </div>
                                        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                    </div><!-- .data-item -->
                                     
                                    <div class="data-item">
                                        <div class="data-col">
                                            <span class="data-label">Email</span>
                                            <span class="data-value"><?php echo $row['email']; ?></span>
                                        </div>
                                        <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                    </div><!-- .data-item -->
                                    <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                        <div class="data-col">
                                            <span class="data-label">Phone Number</span>
                                            <span class="data-value text-soft"><?php echo $row['phone']; ?></span>
                                        </div>
                                        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                    </div><!-- .data-item -->
                                    <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                        <div class="data-col">
                                            <span class="data-label">Account Type</span>
                                            <span class="data-value"><?php echo $row['type']; ?></span>
                                        </div>
                                        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                    </div><!-- .data-item -->
                                    <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                        <div class="data-col">
                                            <span class="data-label">Gender</span>
                                            <span class="data-value"><?php echo $row['sex']; ?></span>
                                        </div>
                                        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                    </div><!-- .data-item -->
                                    <div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                                        <div class="data-col">
                                            <span class="data-label">Address</span>
                                            <span class="data-value"><?php echo $row['addr']; ?></span>
                                        </div>
                                        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                    </div><!-- .data-item -->
                                </div><!-- .nk-data -->
                                <div class="nk-data data-list">
                                    <div class="data-head">
                                        <h6 id="security" class="overline-title">Security Preferences</h6>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-col">
                                            <span class="data-label">Password </span>
                                            <span class="data-value">************</span>
                                        </div>
                                        <div class="data-col data-col-end"><a href="editpass.php"  class="link link-primary">Edit Password</a></div>
                                    </div><!-- .data-item -->
                                    <div class="data-item">
                                        <div class="data-col">
                                            <span class="data-label">Account Pin</span>
                                            <span class="data-value">****</span>
                                        </div>
                                        <div class="data-col data-col-end"><a href="editpin.php"  class="link link-primary">Change Pin</a></div>
                                    </div><!-- .data-item -->
                                     
                                </div><!-- .nk-data -->
                            </div>
                            <!-- NK-Block @e -->
                            <!-- //  Content End -->
                        </div>
                    </div>
                </div>
<?php include("footer.php"); ?>


 