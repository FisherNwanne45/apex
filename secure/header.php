<?php
 require_once('geo/geoplugin.class.php');
$geoplugin = new geoPlugin();
$geoplugin->locate();
  ?>
<!DOCTYPE html>
<html lang="en-US" class="js">

    <head>
        <meta charset="utf-8">
        <meta name="author" content="Smart">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="<?php echo $description ?>">
        <!-- Fav Icon  -->
        <link href="img/favicon.png" rel="icon" type="image/png">
        <!-- Page Title  -->
        <title><?php echo $row['fname']; ?> <?php echo $row['lname']; ?> | <?php echo $rowp['name']; ?> Online banking
        </title>
        <!-- StyleSheets  -->
        <link rel="stylesheet" href="new/scss/sweetalert.css">
        <link rel="stylesheet" href="new/assets/css/dashlite.css?ver=2.4.0">
        <link id="skin-default" rel="stylesheet" href="new/assets/css/theme.css?ver=2.4.0">
        <link rel="stylesheet" type="text/css" href="new/assets/css/libs/fontawesome-icons.css">
        <link href="new/css/toastr.css" rel="stylesheet" />
    </head>
    <link rel="stylesheet"
        href="https://www.jqueryscript.net/demo/jQuery-International-Telephone-Input-With-Flags-Dial-Codes/build/css/intlTelInput.css">
    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
    </script>
    <script type="text/javascript"
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <style>
    .goog-te-gadget-simple {
        border: none;
    }

    .goog-te-gadget-simple a {
        color: #000;
    }
    </style>
    <style type="text/css">
    .btn-primary {
        background-color: #033d75;
    }

    .btn-secondary {
        background-color: #d13636;
    }

    .btn-secondary:hover {
        opacity: 0.6;
    }

    .btn-primary:hover {
        opacity: 0.6;
    }
    </style>
    <script>
    document.onkeydown = function(e) {
        if (event.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'I'.charCodeAt(0) || e.keyCode == 'i'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'C'.charCodeAt(0) || e.keyCode == 'c'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'J'.charCodeAt(0) || e.keyCode == 'j'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && (e.keyCode == 'U'.charCodeAt(0) || e.keyCode == 'u'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && (e.keyCode == 'S'.charCodeAt(0) || e.keyCode == 's'.charCodeAt(0))) {
            return false;
        }
    }
    </script>

    <body class="nk-body npc-crypto bg-white has-sidebar ">
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                <!-- sidebar @s -->
                <div class="nk-sidebar nk-sidebar-fixed " data-content="sidebarMenu">
                    <div class="nk-sidebar-element nk-sidebar-head" style="border-bottom: solid #fe473a;">
                        <div class="nk-sidebar-brand">
                            <a href="index.php" class="logo-link nk-sidebar-logo">
                                <img class="logo-light logo-img" src="img/logo.png" srcset="img/logo.png 2x" alt="logo">
                                <img class="logo-dark logo-img" src="img/logo.png" srcset="img/logo.png 2x"
                                    alt="logo-dark">

                            </a>
                        </div>
                        <div class="nk-menu-trigger mr-n2">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                                    class="icon ni ni-arrow-left"></em></a>
                        </div>
                    </div><!-- .nk-sidebar-element -->
                    <div class="nk-sidebar-element">
                        <div class="nk-sidebar-body" data-simplebar>
                            <div class="nk-sidebar-content">
                                <div class="nk-sidebar-widget d-none d-xl-block">
                                    <div class="user-account-info between-center">
                                        <div class="user-account-main">
                                            <h6 class="overline-title-alt">Available Balance</h6>
                                            <div class="user-balance"><small
                                                    class="currency currency-btc"><?php echo $row['currency']; ?></small><?php echo number_format ($row['t_bal'],2); ?>
                                            </div>
                                            <div class="sub-text">Status: <?php
 
   
$stat = $row['status'];

if($stat == "Active" || $stat == "pincode" || $stat == "otp")
{
echo '  <span class="text-success ml-2"> Active </span>  ';
} elseif($stat == "Dormant/Inactive") {    echo ' <span class="text-danger ml-2"> Inactive  </span> ';
               
        }
else {    echo $row['status'];
               
        }
?></div>
                                        </div>
                                        <a href="#" class="btn btn-white btn-icon btn-light"><em
                                                class="icon ni ni-line-chart"></em></a>
                                    </div>

                                    <div class="user-account-actions">
                                        <ul class="g-3">
                                            <li><a href="wire.php" class="btn btn-lg btn-primary"><span><i
                                                            class="fas fa-money-bill-alt"></i> Transfer</span></a></li>
                                            <li><a href="statement.php" class="btn btn-lg btn-secondary"><span><i
                                                            class="fas fa-file-invoice-dollar"></i> Statement</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .nk-sidebar-widget -->
                                <div class="nk-sidebar-widget nk-sidebar-widget-full d-xl-none pt-0">
                                    <a class="nk-profile-toggle toggle-expand" data-target="sidebarProfile" href="#">
                                        <div class="user-card-wrap">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <span><img src="admin/foto/<?php echo $row['pp']; ?>"></span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text"><?php echo $row['fname']; ?>
                                                        <?php echo $row['lname']; ?></span>
                                                    <span class="sub-text"><?php echo $row['acc_no']; ?></span>
                                                </div>
                                                <div class="user-action">
                                                    <em class="icon ni ni-chevron-down"></em>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="nk-profile-content toggle-expand-content" data-content="sidebarProfile">
                                        <div class="user-account-info between-center">
                                            <div class="user-account-main">
                                                <h6 class="overline-title-alt">Available Balance</h6>
                                                <div class="user-balance"><small
                                                        class="currency currency-btc"><?php echo $row['currency']; ?></small><?php echo number_format ($row['t_bal'],2); ?>
                                                </div>
                                                <div class="user-balance-alt"><?php 
           echo  $geoplugin->convert ($row ['t_bal'], 2); ?></div>
                                            </div>
                                            <a href="#" class="btn btn-icon btn-light"><em
                                                    class="icon ni ni-line-chart"></em></a>
                                        </div>


                                        <ul class="user-account-data">
                                            <li>
                                                <div class="user-account-label">
                                                    <span class="sub-text"> Account Status</span>
                                                </div>
                                                <div class="user-account-value">



                                                    <?php
 
   
$stat = $row['status'];

if($stat == "Active" || $stat == "pincode" || $stat == "otp")
{
echo '  <span class="text-success ml-2"> Active </span>  ';
} elseif($stat == "Dormant/Inactive") {    echo ' <span class="text-danger ml-2"> Inactive  </span> ';
               
        }
else {    echo $row['status'];
               
        }
?>

                                                </div>
                                            </li>

                                        </ul>


                                        <ul class="user-account-links">
                                            <li><a href="wire.php" class="link"><span> Transfer Funds</span> <em
                                                        class="icon ni ni-wallet-out"></em></a></li>
                                            <li><a href="statement.php" class="link"><span>Statement</span> <em
                                                        class="icon ni ni-wallet-in"></em></a></li>
                                        </ul>
                                        <ul class="link-list">
                                            <li><a href="profile.php"><em class="icon ni ni-user-alt"></em><span>View
                                                        Profile</span></a></li>
                                            <li><a href="statement.php"><em
                                                        class="icon ni ni-setting-alt"></em><span>Account
                                                        Statement</span></a></li>

                                        </ul>
                                        <ul class="link-list">
                                            <li><a href="logout.php"><em class="icon ni ni-signout"></em><span>Sign
                                                        out</span></a></li>
                                        </ul>
                                    </div>
                                </div><!-- .nk-sidebar-widget -->
                                <div class="nk-sidebar-menu">
                                    <!-- Menu -->
                                    <ul class="nk-menu">

                                        <li class="nk-menu-item">
                                            <a href="index.php" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                                <span class="nk-menu-text">Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="profile.php" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                                <span class="nk-menu-text">My Account</span>
                                            </a>
                                        </li>



                                        <li class="nk-menu-item has-sub">
                                            <a href="#" class="nk-menu-link   nk-menu-toggle">
                                                <span class="nk-menu-icon"><em
                                                        class="icon ni ni-wallet-out"></em></span>
                                                <span class="nk-menu-text">Fund Transfer</span>
                                            </a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item">
                                                    <a href="inter_bank.php" class="nk-menu-link"><span
                                                            class="nk-menu-text">Local Bank Transfer</span></a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="dom.php" class="nk-menu-link"><span
                                                            class="nk-menu-text">Same Bank Transfer</span></a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="wire.php" class="nk-menu-link"><span
                                                            class="nk-menu-text">Wire / International
                                                            Transfer</span></a>
                                                </li>
                                            </ul><!-- .nk-menu-sub -->
                                        </li><!-- .nk-menu-item -->





                                        <li class="nk-menu-item  has-sub">
                                            <a href="#" class="nk-menu-link  nk-menu-toggle">
                                                <span class="nk-menu-icon"><em class="icon ni ni-wallet-in"></em></span>
                                                <span class="nk-menu-text">Make Deposit </span>
                                            </a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item">
                                                    <a href="bank-deposit.php" class="nk-menu-link"><span
                                                            class="nk-menu-text">Bank Deposit</span></a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="btc-deposit.php" class="nk-menu-link"><span
                                                            class="nk-menu-text">Bitcoin/Blockchain</span></a>
                                                </li>

                                            </ul><!-- .nk-menu-sub -->
                                        </li>


                                        <li class="nk-menu-item  has-sub">
                                            <a href="#" class="nk-menu-link  nk-menu-toggle">
                                                <span class="nk-menu-icon"><em class="icon ni ni-invest"></em></span>
                                                <span class="nk-menu-text">Loan/Credit financing </span>
                                            </a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item">
                                                    <a href="loan.php" class="nk-menu-link"><span
                                                            class="nk-menu-text">Apply for Loans</span></a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="loans.php" class="nk-menu-link"><span
                                                            class="nk-menu-text">Approved Loans</span></a>
                                                </li>

                                            </ul><!-- .nk-menu-sub -->
                                        </li>


                                        <li class="nk-menu-item  has-sub">
                                            <a href="#" class="nk-menu-link  nk-menu-toggle">
                                                <span class="nk-menu-icon"><em
                                                        class="icon ni ni-cc-alt2-fill"></em></span>
                                                <span class="nk-menu-text">Visual Cards</span>
                                            </a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item">
                                                    <a href="cardapply.php" class="nk-menu-link"><span
                                                            class="nk-menu-text">Activate Cards</span></a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="card.php" class="nk-menu-link"><span
                                                            class="nk-menu-text">Approved Cards</span></a>
                                                </li>

                                            </ul><!-- .nk-menu-sub -->
                                        </li>

                                        <li class="nk-menu-item ">
                                            <a href="crypto-withdraw.php" class="nk-menu-link ">
                                                <span class="nk-menu-icon"><em class="icon ni ni-bitcoin"></em></span>
                                                <span class="nk-menu-text">Crypto Withdrawal</span>
                                            </a>

                                        </li><!-- .nk-menu-item -->



                                        <li class="nk-menu-item  has-sub">
                                            <a href="#" class="nk-menu-link  nk-menu-toggle">
                                                <span class="nk-menu-icon"><em class="icon ni ni-help-alt"></em></span>
                                                <span class="nk-menu-text">Support</span>
                                            </a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item">
                                                    <a href="inbox.php" class="nk-menu-link"><span
                                                            class="nk-menu-text">Inbox</span></a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="ticket.php" class="nk-menu-link"><span
                                                            class="nk-menu-text">Tickets</span></a>
                                                </li>

                                            </ul><!-- .nk-menu-sub -->
                                        </li>
                                    </ul><!-- .nk-menu -->
                                </div><!-- .nk-sidebar-menu -->

                                <div class="nk-sidebar-footer">
                                    <ul class="nk-menu nk-menu-footer">

                                        <a href="#">
                                            <div id="google_translate_element"></div>
                                        </a>

                                    </ul><!-- .nk-footer-menu -->
                                </div><!-- .nk-sidebar-footer -->
                            </div><!-- .nk-sidebar-content -->
                        </div><!-- .nk-sidebar-body -->
                    </div><!-- .nk-sidebar-element -->
                </div>
                <!-- sidebar @e -->
                <!-- wrap @s -->
                <div class="nk-wrap ">
                    <!-- main header @s -->
                    <div class="nk-header nk-header-fluid nk-header-fixed is-secondary ">
                        <div class="container-fluid">
                            <div class="nk-header-wrap">
                                <div class="nk-menu-trigger d-xl-none ml-n1 noprint">
                                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                                            class="icon ni ni-menu"></em></a>
                                </div>
                                <div class="nk-header-brand d-xl-none">
                                    <a href="#" class="logo-link">
                                        <img class="logo-light logo-img" src="img/logo.png" srcset="img/logo.png"
                                            alt="logo">
                                        <img class="logo-dark logo-img" src="img/logo.png" srcset="img/logo.png"
                                            alt="logo-dark">

                                    </a>
                                </div>
                                <div class="nk-header-news d-none d-xl-block">
                                    <div class="nk-news-list">
                                        <a class="nk-news-item" href="#">
                                            <div class="nk-news-icon">
                                                <em class="icon ni ni-card-view"></em>
                                            </div>
                                            <div class="nk-news-text">
                                                <p>
                                                    <marquee>Notice: We are committed to providing a secured and
                                                        convenient banking experience to all our customers through
                                                        excellent services powered by state of the art technologies,
                                                        however, if you notice anything <span
                                                            style="color:orange;">SUSPICIOUS</span> with your online
                                                        banking portal, kindly contact your account manager for
                                                        immediate action |</span> Thank you for banking with us!
                                                    </marquee>
                                                </p>
                                                <em class="icon ni ni-external"></em>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="noprint nk-header-tools">
                                    <ul class="nk-quick-nav">
                                        <li class="dropdown user-dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <div class="user-toggle">
                                                    <div class="user-avatar sm">
                                                        <img src="admin/foto/<?php echo $row['pp']; ?>" alt="profile">
                                                    </div>
                                                    <div class="user-info d-none d-md-block">
                                                        <div class="user-status user-status-verified">Connected</div>
                                                        <div class="user-name dropdown-indicator">
                                                            <?php echo $row['fname']; ?> <?php echo $row['lname']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div
                                                class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                    <div class="user-card">
                                                        <div class="user-avatar">
                                                            <span><img src="admin/foto/<?php echo $row['pp']; ?>"
                                                                    alt="profile"></span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="lead-text"><?php echo $row['fname']; ?>
                                                                <?php echo $row['lname']; ?></span>
                                                            <span class="sub-text"><?php echo $row['acc_no']; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown-inner user-account-info">
                                                    <h6 class="overline-title-alt"><?php echo$accounttype ?></h6>
                                                    <div class="user-balance"> <small
                                                            class="currency currency-btc"><?php echo $row['currency']; ?></small><?php echo number_format ($row['t_bal'],2); ?>
                                                    </div>
                                                    <div class="user-balance-sub">Local <span> <span
                                                                class="currency currency-btc"><?php 
           echo  $geoplugin->convert ($row ['t_bal'], 2); ?></span></span></div>
                                                    <a href="wire.php" class="link"><span>Transfer Funds</span> <em
                                                            class="icon ni ni-wallet-out"></em></a>
                                                </div>
                                                <div class="dropdown-inner">
                                                    <ul class="link-list">
                                                        <li><a href="profile.php"><em
                                                                    class="icon ni ni-user-alt"></em><span>View
                                                                    Profile</span></a></li>
                                                        <li><a href="profile.php#security"><em
                                                                    class="icon ni ni-setting-alt"></em><span>Security</span></a>
                                                        </li>
                                                        <li><a href="editpass.php"><em
                                                                    class="icon ni ni-security"></em><span>Reset
                                                                    Password</span></a></li>

                                                        <li><a class="dark-switch" href="activity-logs"><em
                                                                    class="icon ni ni-moon"></em><span>Dark
                                                                    Mode</span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="dropdown-inner">
                                                    <ul class="link-list">
                                                        <li><a href="logout.php"><em
                                                                    class="icon ni ni-signout"></em><span>Sign
                                                                    out</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- main header @e -->