<!DOCTYPE html>
<head>
<title>SGA Elections 2014</title>
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
session_destroy();
session_start();
include_once 'db.inc.php';
include_once 'functions.inc.php';
include_once '/var/www/bill/inc/calendar/inc/auth.php';
$db=new PDO(DB_INFO,DB_USER,DB_PASS);
/*include_once '/var/www/bill/inc/loggedin.inc.php';*/
/*include_once '/var/www/bill/inc/pam_auth2.php';*/
$username=htmlentities($_POST['id']);
$schoolpass=htmlentities($_POST['schoolpass']);
/*
if (is_numeric($username)) {
	if (strlen($username) == 8) { // clip off year code
		$username = substr($username, 2, 6);
	}
	$q = "SELECT uname FROM bill.userinfo WHERE id='$username'";
	$result = cnt_mysql_query($q);
	if (list($priuname) = mysql_fetch_row($result)) {
		$username = $priuname;
	}
}
*/
/* id to username convert */
$sql = "SELECT uname FROM users WHERE id=? LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute(array($username));
$billusername="";
while($row = $stmt->fetch()){
	$billusername=$row['uname'];
}
if(pam_auth2($billusername,$schoolpass)){
	//username and password are correct, but we need to make sure this person hasn't voted already
	$sql="SELECT COUNT(*) AS num_votes FROM students WHERE id=? AND voted=?";
	$stmt = $db->prepare($sql);
	$stmt->execute(array($username,'0'));
	$response=$stmt->fetch();
	if($response['num_votes']==1){
	
		$_SESSION['logged_in']=true;
		$_SESSION['billusername']=$username;
		
		$_SESSION['studentid']=$username;
		$_SESSION['startedvoting']=false;
		echo "Authentication successful";
		header('Location:/vote.php');//header to voting page here
	}
	else{
		$_SESSION['err']=-1;
		header('Location:/index.php?err=1');
	}
}
else{
	echo "Authentication failed";
	header('Location:/index.php');
}


?>

</body>
</html>
