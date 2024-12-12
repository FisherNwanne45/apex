<?php

require_once 'dbconfig.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function create($fname,$mname,$lname,$uname,$upass,$upass2,$phone,$email,$type,$reg_date,$work,$acc_no,$addr,$sex,$dob,$marry,$t_bal,$a_bal,$currency,$cot,$tax,$lppi,$imf,$image,$pp)
	{
		try
		{							
			$upass = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO account(fname,mname,lname,uname,upass,upass2,phone,email,type,reg_date,work,acc_no,addr,sex,dob,marry,t_bal,a_bal,currency,cot,tax,lppi,imf,image,pp) 
			                                             VALUES(:fname, :mname, :lname, :uname, :upass, :upass2, :phone, :email, :type, :reg_date, :work, :acc_no, :addr, :sex, :dob, :marry, :t_bal, :a_bal, :currency, :cot, :tax, :lppi, :imf, :image, :pp)");
			
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":mname",$mname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":uname",$uname);
			$stmt->bindparam(":upass",$upass);
			$stmt->bindparam(":upass2",$upass2);
			$stmt->bindparam(":phone",$phone);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":reg_date",$reg_date);
			$stmt->bindparam(":work",$work);
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":addr",$addr);
			$stmt->bindparam(":sex",$sex);
			$stmt->bindparam(":dob",$dob);
			$stmt->bindparam(":marry",$marry);
			$stmt->bindparam(":t_bal",$t_bal);
			$stmt->bindparam(":a_bal",$a_bal);
			$stmt->bindparam(":currency",$currency);
			$stmt->bindparam(":cot",$cot);
			$stmt->bindparam(":tax",$tax);
			$stmt->bindparam(":lppi",$lppi);
			$stmt->bindparam(":imf",$imf);
			$stmt->bindparam(":image",$image);
			$stmt->bindparam(":pp",$pp);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function signup($fname,$mname,$lname,$upass,$upass2,$phone,$email,$type,$work,$addr,$sex,$dob,$marry,$currency,$code,$image,$pp)
	{
		try
		{							
			$upass = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO temp_account(fname,mname,lname,upass,upass2,phone,email,type,work,addr,sex,dob,marry,currency,code,image,pp) 
			                                             VALUES(:fname, :mname, :lname, :upass, :upass2, :phone, :email, :type, :work, :addr, :sex, :dob, :marry, :currency, :code, :image, :pp)");
			
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":mname",$mname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":upass",$upass);
			$stmt->bindparam(":upass2",$upass2);
			$stmt->bindparam(":phone",$phone);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":work",$work);
			$stmt->bindparam(":addr",$addr);
			$stmt->bindparam(":sex",$sex);
			$stmt->bindparam(":dob",$dob);
			$stmt->bindparam(":marry",$marry);
			$stmt->bindparam(":currency",$currency);
			$stmt->bindparam(":code",$code);
			$stmt->bindparam(":image",$image);
			$stmt->bindparam(":pp",$pp);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function his($uname,$amount,$sender_name,$type,$remarks,$date,$time)
	{
		try
		{							
			$stmt = $this->conn->prepare("INSERT INTO alerts(uname,amount,sender_name,type,remarks,date,time) 
			                                             VALUES(:uname, :amount, :sender_name, :type, :remarks, :date, :time)");
			
			$stmt->bindparam(":uname",$uname);
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":sender_name",$sender_name);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":remarks",$remarks);
			$stmt->bindparam(":date",$date);
			$stmt->bindparam(":time",$time);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function transfer($amount,$uname,$bank_name,$acc_name,$acc_no,$type,$swift,$routing,$remarks,$email,$phone)
	{
		try
		{							
			
			$stmt = $this->conn->prepare("INSERT INTO transfer(amount,uname,bank_name,acc_name,acc_no,type,swift,routing,remarks,email,phone) 
			                                             VALUES(:amount, :unmae, :bank_name, :acc_name, :acc_no, :type, :swift, :routing, :remarks, :email, :phone)");
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":uname",$uname);
			$stmt->bindparam(":bank_name",$bank_name);
			$stmt->bindparam(":acc_name",$acc_name);
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":swift",$swift);
			$stmt->bindparam(":routing",$routing);
			$stmt->bindparam(":remarks",$remarks);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":phone",$phone);
			
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function ticket($tc,$sender_name,$subject,$msg,$status)
	{
		try
		{							
			
			$stmt = $this->conn->prepare("INSERT INTO ticket(tc,sender_name,subject,msg,$tatus) 
			                                             VALUES(:tc, :sender_name, :subject, :msg, :status)");
			$stmt->bindparam(":tc",$tc);
			$stmt->bindparam(":sender_name",$sender_name);
			$stmt->bindparam(":subject",$subject);
			$stmt->bindparam(":msg",$msg);
			$stmt->bindparam(":status",$status);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function message($sender_name,$reci_name,$subject,$msg)
	{
		try
		{							
			
			$stmt = $this->conn->prepare("INSERT INTO message(sender_name,reci_name,subject,msg) 
			                                             VALUES(:sender_name, :reci_name, :subject, :msg)");
			
			$stmt->bindparam(":sender_name",$sender_name);
			$stmt->bindparam(":reci_name",$reci_name);
			$stmt->bindparam(":subject",$subject);
			$stmt->bindparam(":msg",$msg);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function del($id)
	{
		try
		{							
			
			$stmt = $this->conn->prepare("DELETE FROM account WHERE id = :id"); 
			                                            
			$stmt->bindparam(":id",$id);
			
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function update($fname,$mname,$lname,$uname,$upass,$upass2,$phone,$email,$type,$work,$acc_no,$addr,$sex,$dob,$marry,$t_bal,$a_bal,$cot,$tax,$lppi,$imf,$currency)
	{
		try
		{	$id=$_GET['id'];				
			$upass = md5($upass);
			$stmt = $this->conn->prepare("UPDATE account SET fname = :fname, mname = :mname, lname = :lname, uname = :uname, upass = :upass, upass2 = :upass2, phone = :phone, email = :email, type = :type, work = :work, acc_no = :acc_no, addr = :addr, sex = :sex, dob = :dob, marry = :marry, t_bal = :t_bal, a_bal = :a_bal, cot = :cot, tax = :tax, lppi = :lppi, imf = :imf, currency = :currency, WHERE id='$id'");
			
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":mname",$mname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":uname",$uname);
			$stmt->bindparam(":upass",$upass);
			$stmt->bindparam(":upass2",$upass2);
			$stmt->bindparam(":phone",$phone);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":work",$work);
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":addr",$addr);
			$stmt->bindparam(":sex",$sex);
			$stmt->bindparam(":dob",$dob);
			$stmt->bindparam(":marry",$marry);
			$stmt->bindparam(":t_bal",$t_bal);
			$stmt->bindparam(":a_bal",$a_bal);
			$stmt->bindparam(":cot",$cot);
			$stmt->bindparam(":tax",$tax);
			$stmt->bindparam(":lppi",$lppi);
			$stmt->bindparam(":imf",$imf);
			$stmt->bindparam(":currency",$currency);
			$stmt->execute();	
			return $stmt;
		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function updatepic($image,$pp)
	{
		try
		{	$id=$_GET['id'];				
			$stmt = $this->conn->prepare("UPDATE account SET image = :image, pp = :pp WHERE id='$id'");
			
			$stmt->bindparam(":image",$image);
			$stmt->bindparam(":pp",$pp);
			$stmt->execute();	
			return $stmt;
		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function upstat($status)
	{
		try
		{	$id=$_GET['id'];				
			$stmt = $this->conn->prepare("UPDATE account SET status = :status WHERE id='$id'");
			
			$stmt->bindparam(":status",$status);
		    $stmt->execute();	
			return $stmt;
		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
		public function upgrade($name,$phone,$email,$addr,$tawk2,$qr)
	{
		try
		{	$id=$_GET['id'];				
			$stmt = $this->conn->prepare("UPDATE site SET name = :name, phone = :phone, email = :email, addr = :addr, tawk2 = :tawk2, qr = :qr WHERE id='$id'");
			
			$stmt->bindparam(":name",$name);
			$stmt->bindparam(":phone",$phone);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":addr",$addr);
			$stmt->bindparam(":tawk2",$tawk2);
			$stmt->bindparam(":qr",$qr);
			$stmt->execute();	
			return $stmt;
		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function upgradecd($code1,$code2,$code3,$code1b,$code2b,$code3b)
	{
		try
		{	$id=$_GET['id'];				
			$stmt = $this->conn->prepare("UPDATE site SET code1 = :code1, code2 = :code2, code3 = :code3, code1b = :code1b, code2b = :code2b, code3b = :code3b WHERE id='$id'");
			
			$stmt->bindparam(":code1",$code1);
			$stmt->bindparam(":code2",$code2);
			$stmt->bindparam(":code3",$code3);
			$stmt->bindparam(":code1b",$code1b);
			$stmt->bindparam(":code2b",$code2b);
			$stmt->bindparam(":code3b",$code3b);
			$stmt->execute();	
			return $stmt;
		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function updates($ccard,$ccdate,$cvv,$loan,$lodur,$intra)
	{
		try
		{	$id=$_GET['id'];				
			$stmt = $this->conn->prepare("UPDATE account SET ccard = :ccard, ccdate = :ccdate, cvv = :cvv, loan = :loan, lodur = :lodur, intra = :intra WHERE id='$id'");
			
			$stmt->bindparam(":ccard",$ccard);
			$stmt->bindparam(":ccdate",$ccdate);
			$stmt->bindparam(":cvv",$cvv);
			$stmt->bindparam(":loan",$loan);
			$stmt->bindparam(":lodur",$lodur);
			$stmt->bindparam(":intra",$intra);
			$stmt->execute();	
			return $stmt;
		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function updatecd($amount,$date,$time,$remarks,$sender_name)
	{
		try
		{	$id=$_GET['id'];				
			$stmt = $this->conn->prepare("UPDATE alerts SET amount = :amount, date = :date, time = :time, remarks = :remarks, sender_name = :sender_name WHERE id='$id'");
			
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":date",$date);
			$stmt->bindparam(":time",$time);
			$stmt->bindparam(":remarks",$remarks);
			$stmt->bindparam(":sender_name",$sender_name);
			$stmt->execute();	
			return $stmt;
		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function updatetf($amount,$date,$acc_no,$remarks,$bank_name,$acc_name)
	{
		try
		{	$id=$_GET['id'];				
			$stmt = $this->conn->prepare("UPDATE transfer SET amount = :amount, date = :date, acc_no = :acc_no, remarks = :remarks, bank_name = :bank_name, acc_name = :acc_name WHERE id='$id'");
			
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":date",$date);
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":remarks",$remarks);
			$stmt->bindparam(":bank_name",$bank_name);
			$stmt->bindparam(":acc_name",$acc_name);
			$stmt->execute();	
			return $stmt;
		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM admin WHERE email=:email");
			$stmt->execute(array(":email"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['verified_count']=="Y")
				{
					if($userRow['upass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['id'];
						return true;
					}
					else
					{
						header("Location: login.php?error");
						exit;
					}
				}
				else
				{
					header("Location: login.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: login.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
 
	function send_mail($email,$messag,$subject)
	{						
		require('PHPMailer-master/src/PHPMailer.php');
		require('PHPMailer-master/src/SMTP.php');
		require('PHPMailer-master/src/Exception.php');
		require('PHPMailer-master/src/OAuth.php');
		require('PHPMailer-master/src/POP3.php');
		include("../config.php");
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "STARTTLS";                 
		$mail->Host       = $smtphost;      
		$mail->Port       = 587;             
		$mail->AddAddress($email);
		$mail->Username= $user;  
		$mail->Password= $pass;            
		$mail->SetFrom($from);
		$mail->FromName = $frname;
		$mail->AddReplyTo = $reply;
		$mail->Subject    = $subject;
		$mail->MsgHTML($messag);
		$mail->Send();
	}	
}
?>