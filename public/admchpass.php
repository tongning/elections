<!DOCTYPE html>
<head>
<title>Change Admin Password</title>
</head>
<body>
<?php
session_start();
include_once 'functions.inc.php';
include_once 'db.inc.php';
$db=new PDO(DB_INFO,DB_USER,DB_PASS);
if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1){
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$oldpass=htmlentities($_POST['currpass']);
		$newpass=htmlentities($_POST['newpass']);
		$newpasscfrm=htmlentities($_POST['newpasscfrm']);
		if($newpass != $newpasscfrm){
			echo "Passwords not identical";
			exit;
		}
		//make sure old pass is correct
		$sql="SELECT salt
		FROM admins
		WHERE username=?";
		$stmt=$db->prepare($sql);
		$stmt->execute(array("admin"));
		$e=$stmt->fetchAll();
	
		$salt="";
		foreach($e as $currsalt){
			$salt=$currsalt['salt'];
		}
		$stmt=$db->prepare("SELECT COUNT(*) AS num_match FROM admins  WHERE username=? && password=?");
		$password=hashsalt($oldpass,$salt);
		$stmt->execute(array("admin", $password));
		$response=$stmt->fetch();
		if($response['num_match']==1){
			//everything looks good, change the password
			$sql="UPDATE admins
				SET password=?, salt=?
				WHERE username=?
				LIMIT 1";
			$newsalt=time();
			$newhash=hashsalt($newpass,$newsalt);
			$stmt=$db->prepare($sql);
			$stmt->execute(array($newhash,$newsalt,"admin"));
			$stmt->closeCursor();
			echo "Password updated successfully.<br>";
			echo "<a href='admhome.php'>Admin home</a>";
		}
		else{
			echo "Old password wrong";
			exit;
		}
	
	}
	else{
		echo '
		<h2>Change password</h2>
		<form name="changepass" action="admchpass.php" method="post">
		Current password:<br><input type="password" name="currpass"><br>
		New password:<br><input type="password" name="newpass"><br>
		Confirm:<br><input type="password" name="newpasscfrm"><br>
		<input type="submit" value="Submit">
		</form>
		
		
		';
	
	}
}
else{
	echo "Not logged in as admin";
	exit;
}

?>

</body>
</html>