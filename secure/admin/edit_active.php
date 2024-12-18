<?php
session_start();
session_regenerate_id(true); // Enhance session security

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require_once 'class.admin.php';
$reg_user = new USER();

// Initialize variables
$currentValue = '';
$id = null;

// Fetch account details if 'id' is provided
if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $stmt = $reg_user->runQuery("SELECT * FROM account WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $currentValue = $row['status'] ?? null;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upstat'])) {
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

    if ($status) {
        $updateStmt = $reg_user->runQuery("UPDATE account SET status = :status WHERE id = :id");
        $updateStmt->bindParam(":status", $status, PDO::PARAM_STR);
        $updateStmt->bindParam(":id", $id, PDO::PARAM_INT);

        try {
            $updateStmt->execute();
            header("Refresh: 2");
            $msg = "
                <div class='alert alert-success'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Account was successfully updated!</strong>
                </div>
            ";
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $msg = "
                <div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error:</strong> Failed to update the account.
                </div>
            ";
        }
    }
}
?>

<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="icon" href="img/favicon.png" type="image/x-icon">

    <title> Edit Account</title>

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/form.css" rel="stylesheet">
    <link href="css/calendar.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/icons.css" rel="stylesheet">
    <link href="css/generics.css" rel="stylesheet">
</head>

<body id="skin-blur-nexus">

    <header id="header" class="media">
        <a href="index.php" id="menu-toggle"></a>
        <a class="logo pull-left" href="index.php"><img src="" class="img-responsive" alt=""></a>

        <div class="media-body">
            <div class="media" id="top-menu">

                <div id="time" class="pull-right">
                    <span id="hours"></span>
                    :
                    <span id="min"></span>
                    :
                    <span id="sec"></span>
                </div>


            </div>
        </div>
    </header>

    <div class="clearfix"></div>

    <section id="main" class="p-relative" role="main">

        <!-- Sidebar -->
        <aside id="sidebar">

            <!-- Sidbar Widgets -->
            <div class="side-widgets overflow">
                <!-- Profile Menu -->
                <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
                    <a href="index.php" data-toggle="dropdown">
                        <img class="profile-pic animated" src="img/sc.png" alt="">
                    </a>
                    <ul class="dropdown-menu profile-menu">

                        <li><a href="logout.php">Sign Out</a> <i class="fa fa-sign-out icon left">&#61903;</i><i
                                class="icon right fa fa-sign-out">&#61815;</i></li>
                        <li><a href="#edit" data-toggle="modal">Edit Profile</a><i class="right fa fa-edit fa-2x"></i>
                        </li>
                    </ul>
                    <h4 class="m-0">Admin Dashboard</h4>

                </div>

                <!-- Calendar -->
                <div class="s-widget m-b-25">
                    <div id="sidebar-calendar"></div>
                </div>

                <!-- Feeds -->
                <div class="s-widget m-b-25">
                    <h2 class="tile-title">
                        Developer Info
                    </h2>
                    <div class="">

                        <p><i class="fa fa-skype fa-2x"></i> Fisher Nwanne</p>
                    </div>
                    <div class="s-widget-body">
                        <div id="news-feed"></div>
                    </div>
                </div>

                <!-- Projects -->

            </div>

            <!-- Side Menu -->
            <ul class="list-unstyled side-menu">
                <li class="">
                    <a class="sa-side-home" href="index.php">
                        <span class="menu-item">Dashboard</span>
                    </a>
                </li>
                <li class="dropdown active">
                    <a class="sa-list-vcard" href="">
                        <span class="menu-item">Accounts</span>
                    </a>
                    <ul class="list-unstyled menu-item">
                        <li><a href="create_account.php">Create Account</a></li>
                        <li><a href="view_account.php">View Accounts</a></li>
                        <li><a href="update.php">Update Accounts</a></li>
                        <li><a href="upload.php">Upload Image</a></li>
                    </ul>
                </li>
                <li>
                    <a class="sa-list-secret" href="pending_accounts.php">
                        <span class="menu-item">Pending Accounts</span>
                    </a>
                </li>
                <li>
                    <a class="sa-top-message" href="messages.php">
                        <span class="menu-item">Messages</span>
                    </a>
                </li>
                <li>
                    <a class="sa-list-comment" href="tickets.php">
                        <span class="menu-item">Tickets</span>
                    </a>
                </li>
                <li>
                    <a class="sa-list-database" href="credit_debit_list.php">
                        <span class="menu-item">Credit/Debit History</span>
                    </a>
                </li>
                <li>
                    <a class="sa-list-cc" href="transfer_rec.php">
                        <span class="menu-item">Transaction Records</span>
                    </a>
                </li>
                <li>
                    <a class="sa-list-cog" href="settings.php">
                        <span class="menu-item">Settings</span>
                    </a>
                </li>

            </ul>

        </aside>
        <!-- Main Content -->
        <section id="content" class="container">
            <h4 class="page-title block-title">Update Account</h4>
            <a class="btn btn-md" href="update.php">Go Back</a>

            <div class="block-area" id="required">
                <?php if (isset($msg)) echo $msg; ?>
                <h4>Edit Status for <?php echo htmlspecialchars($row['fname'] ?? ''); ?>
                    <?php echo htmlspecialchars($row['lname'] ?? ''); ?> -
                    Acc No: <?php echo htmlspecialchars($row['acc_no'] ?? ''); ?></h4>

                <form method="POST">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Set Status</label>
                            <select name="status" class="form-control input-sm">
                                <option value="Active" <?php echo ($currentValue === 'Active') ? 'selected' : ''; ?>>
                                    Active (With 3 Security Codes)</option>
                                <option value="pincode" <?php echo ($currentValue === 'pincode') ? 'selected' : ''; ?>>
                                    Active (With only 1 pincode)</option>
                                <option value="Dormant/Inactive"
                                    <?php echo ($currentValue === 'Dormant/Inactive') ? 'selected' : ''; ?>>
                                    Dormant/Inactive</option>
                                <option value="Closed" <?php echo ($currentValue === 'Closed') ? 'selected' : ''; ?>>
                                    Closed</option>
                                <option value="Disabled"
                                    <?php echo ($currentValue === 'Disabled') ? 'selected' : ''; ?>>Disabled</option>
                            </select>
                        </div>
                    </div>

                    <input class="btn btn-md" type="submit" name="upstat" value="Update Status">
                </form>
            </div>
        </section>
    </section>

    <!-- Javascript Libraries -->
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script> <!-- jQuery Library -->


    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Charts -->
    <script src="js/validation/validate.min.js"></script> <!-- jQuery Form Validation Library -->
    <script src="js/validation/validationEngine.min.js"></script>
    <!-- jQuery Form Validation Library - requirred with above js -->
    <script src="js/sparkline.min.js"></script> <!-- Sparkline - Tiny charts -->
    <script src="js/easypiechart.js"></script> <!-- EasyPieChart - Animated Pie Charts -->
    <script src="js/charts.js"></script> <!-- All the above chart related functions -->
    <script src="js/datetimepicker.min.js"></script> <!-- Date & Time Picker -->


    <!-- UX -->
    <script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->

    <!-- Other -->
    <script src="js/calendar.min.js"></script> <!-- Calendar -->
    <script src="js/feeds.min.js"></script> <!-- News Feeds -->


    <!-- All JS functions -->
    <script src="js/functions.js"></script>
</body>

</html>