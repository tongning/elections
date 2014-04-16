<!DOCTYPE html>
<head>
<title>SGA Elections 2014</title>
</head>
<body>
<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');
*/
session_start();
session_destroy();
session_start();
include_once 'db.inc.php';
include_once 'functions.inc.php';
include_once '/var/www/bill/inc/calendar/inc/auth.php';
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

if(pam_auth2($username,$schoolpass)){
	$_SESSION['logged_in']=true;
	$_SESSION['billusername']=$username;
	/*obviously this will be edited once we get the username/id pairing info*/
	$_SESSION['studentid']="416117";
	$_SESSION['startedvoting']=false;
	echo "Authentication successful";
	header('Location:/vote.php');//header to voting page here
}
else{
	echo "Authentication failed";
	header('Location:/index.php');
}


?>

</body>
</html>
