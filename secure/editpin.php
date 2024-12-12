<?php
session_start();
include_once ('session.php');
require_once 'class.user.php';
if(!isset($_SESSION['acc_no'])){
	
header("Location: login.php");
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

if($stat == 'Dormant/Inactive'){
	header('Location: index.php?dormant');
	exit();
}
if(isset($_POST['reset-pin']))
		{
			$pin = $_POST['mname'];
			$cpin = $_POST['mname7'];
			
			if($cpin!==$pin)
			{
				$msg = "<div class='alert alert-danger'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Sorry!</strong>  Pin Confirmation Doesn't match. 
						</div>";
			}
			else
			{
			 
				$stmt = $reg_user->runQuery("UPDATE account SET mname=:mname WHERE acc_no=:acc_no");
				$stmt->execute(array(":mname"=>$pin,":acc_no"=>$_SESSION['acc_no']));
				
				$msg = "<div class='alert alert-success '>
						<button class='close' data-dismiss='alert'>&times;</button>
						Pin Changed Successfully! &nbsp;
						</div>";
				
			}
		}	
	
	
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
                                        <h4 class="nk-block-title fw-normal"> Security Setting </h4>
                                        <div class="nk-block-des">
                                            <p> <?php echo $rowp['name']; ?> Security Setting.</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li><a href="profile.php" class="btn btn-secondary btn-light text-light"><span>Preferences</span><em class="icon ni ni-wallet-in"></em></a></li>
                                        </ul>

                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                        </div>
                    </div> 
                  <div class="card card-bordered">
               <div class="card-header font-weight-bold text-light" style="background-color:#033d75;">  Reset Pin</div>
          <div class="card-inner">
         
         <div class="card-body">  
              
              
              
               <form  method="POST"  >
          
          			    							    																																				          
                             
                    			<?php if(isset($msg)) echo $msg;  ?>						
                <h6 class="heading-small text-muted mb-4">Update your Pin below</h6>
                <div class="pl-lg-4">
                    
       
                    
                        
                         <div class="row">
                     
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-label" for="input-email">New Pin</label>
                        <input type="password" class="form-control form-control-alternative" name="mname" placeholder="****"  required="">
                      </div>
                    </div></div>  <br>
                    <div class="row">
                        
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-label" for="input-first-name">Retype New Pin</label>
                        <input type="password" class="form-control form-control-alternative" name="mname7" placeholder="****" required="">
                      </div>
                    </div>
                  
                  
                    
                    
                  </div>
                    
                </div>
                <br>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                         <button class="btn btn-primary" type="submit" name="reset-pin" value="Update Pin"> Change Pin </button>
                      </div>
                    </div>
                  </div>
                 
                </div>
                
              </form>
              
              
              
              
            </div>
          </div>
        
    
      
      
      
       
        
        
     
    </div>
</div>
 
<?php include("footer.php"); ?>