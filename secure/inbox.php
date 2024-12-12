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
$user_home = new USER();

$stmt = $user_home->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$site = $row['site'];

$stct = $user_home->runQuery("SELECT * FROM site WHERE id = '20'");
$stct->execute(array(":acc_no"=>$_SESSION['acc_no']));
$rowp = $stct->fetch(PDO::FETCH_ASSOC);


include_once ('counter.php');
?>

 
 

<?php include("header.php"); ?>
 <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-head-sub">
                                </div>
                                <div class="nk-block-between-md g-4 card-bordered">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title fw-normal"> Messages </h4>
                                        <div class="nk-block-des">
                                            <p>All  <?php echo $rowp['name']; ?> Support Messages.</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li><a href="ticket.php" class="btn btn-secondary btn-light text-light"><span>Open Ticket</span><em class="icon ni ni-wallet-in"></em></a></li>
                                        </ul>

                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                        </div>
                    </div> 
                  <div class="card card-bordered">
               <div class="card-header font-weight-bold text-light" style="background-color:#033d75;">  Messages Inbox</div>
          <div class="card-inner">
         
         <div class="card-body">  
              
               <form autocomplete="off" method="post">
                         
                
               <div class="mail-box-container">
		                <!-- BEGIN scrollbar -->
		                <div data-scrollbar="true" data-height="100%">
		                    
            <?php 
								$reci_name = $row['uname'];
								$msg = $user_home->runQuery("SELECT * FROM message INNER JOIN account ON message.reci_name= account.uname  WHERE account.uname = '$reci_name'");
								$msg->execute(array(":reci_name"=>$_SESSION['uname']));
								while($show = $msg->fetch(PDO::FETCH_ASSOC)){?>
								
		                   
								 
								
									<div class="form-check custom-control custom-checkbox">
										<a href="message_view.php?subject=<?php echo $show['subject']; ?>">
											<div class="custom-control-label text-3" for="announcements">
												<span class="d-block text-2 font-weight-300"><?php echo $show['date']; ?></span>
												<?php echo $show['sender_name']; ?>
											</div> 
											<p class="text-muted line-height-3 mt-2"><?php echo $show['subject']; ?></p>
										</a>
									</div>
							 
							
            
            
             
              <hr class="mx-n4">
              <?php } ?>
              
           
		                </div>
		                <!-- END scrollbar -->
		            </div>
               
                
              </form>
              
              
              
            </div>
          </div>
        
    
      
      
      
       
        
        
     
    </div>
</div>
 
<?php include("footer.php"); ?>