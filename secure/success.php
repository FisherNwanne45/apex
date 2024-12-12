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
$url != 'success.php';

if ($_SERVER['HTTP_REFERER'] == $url) {
  header('Location: wire.php'); //redirect to some other phage
  exit();
}

$reg_user = new USER();
$site = $row['site'];

$stct = $reg_user->runQuery("SELECT * FROM site WHERE id = '20'");
$stct->execute(array(":acc_no"=>$_SESSION['acc_no']));
$rowp = $stct->fetch(PDO::FETCH_ASSOC);

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$email = $row['email'];

$temp = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email' ORDER BY id DESC LIMIT 1");
$temp->execute(array(":acc_no"=>$_SESSION['acc_no']));
$rows = $temp->fetch(PDO::FETCH_ASSOC);

include_once ('counter.php');
?>
  
  <style>
    @media print {
      .noprint {
        display: none;
      }
      .print-only {
        display: block;
      }
      .receipt {
        width: 100%;
        display: block;
        background-color: #ffffff;
        -webkit-print-color-adjust: exact;
      }
    }
  </style>
<?php include("header.php"); ?>
             <div class="nk-content nk-content-fluid">
              <div class="container-xl wide-lg">
               <div class="nk-content-body">
             <div class="modal-content">
                <div class="modal-body modal-body-lg text-center">
                    <div class="nk-modal">
                        <div class="card-header receipt font-weight-bold text-light" style="font-size: 25px; background-color:#033d75; "> <?php echo $rowp['name']; ?> </div>
                        <br><br>
                        <div class="noprint nk-modal-text">
                        <em class=" nk-modal-icon icon icon-circle icon-circle-xxl ni ni-check bg-success"></em>
                        
                        </div><div class="  nk-modal-text">
                            <h4 class="nk-modal-title">Transaction Receipt!</h4>
                            <p class="caption-text">You have successfully transfered <strong><?php echo $row['currency']?><?php echo $rows['amount']?> to <strong><?php echo $rows['acc_name']; ?></strong>.</p>
                           
                           <b>Details of your transaction are shown below;</b>
                        </div>
                        <ul class="buysell-overview-list">
                                <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Amount Debited</span></span>
                                    <span class="pm-title"><?php echo $row['currency']?><?php echo $rows['amount']?></span>
                                </li>
                                 <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Recipient Account:</span></span>
                                    <span class="pm-title"><?php echo $rows['acc_no']?></span>
                                </li>

                                <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Account holder:</span></span>
                                    <span class="pm-title"><?php echo $rows['acc_name']; ?></span>
                                </li>

                                <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Bank Name:</span></span>
                                    <span class="pm-title"><?php echo $rows['bank_name']; ?></span>
                                </li>

                                <li class="buysell-overview-item">
                                <span class="pm-currency"><em class="icon ni ni-check-circle-fill"></em> <span>Date Generated:</span></span>
                                    <span class="pm-title"><?php echo date("d-m-Y"); ?></span>
                                </li>

                                


                            </ul>
                        <div class="noprint nk-modal-action-lg">
                            <ul class="btn-group gx-4">
                                <li><a href="# " onclick="showPrintElements(); window.print();" class="btn btn-lg btn-mw btn-primary"><span>Print Receipt</span><em class="icon ni ni-printer"></em></a></li>
                                <li><a href="index.php" class="btn btn-lg btn-mw btn-secondary">Back to home</a></li>
                            </ul>
                        </div>
                    </div>
                </div><!-- .modal-body -->
                <div class="modal-footer bg-lighter">
                    <div class="text-center w-100">
                        <p>All electronic fund transfers to or from your accounts at <?php echo $rowp['name']; ?> are governed by the Electronic Fund Transfer Disclosure provided to you when you established your account or when you requested other electronic fund transfer services.</p><b>International transfer will take 2-3 days to be processed and sent.</b>
                    </div>
                </div>
            </div>
          </div>
      </div>
  </div>
 <script>
  function showPrintElements() {
    var printElements = document.getElementsByClassName("print-only");
    for (var i = 0; i < printElements.length; i++) {
      printElements[i].style.display = "block";
    }
  }
</script>
      <?php  include("footer.php");?>