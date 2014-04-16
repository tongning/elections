<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'
	&& !empty($_POST['enteredcode'])){
	echo "Please wait while you are authenticated.";
	$enteredcode=htmlentities($_POST['enteredcode']);
	include_once 'db.inc.php';
	include_once 'functions.inc.php';
	$db = new PDO(DB_INFO, DB_USER, DB_PASS);
	$studentid=htmlentities($_SESSION['studentid']);
	$stmt=$db->prepare("SELECT id, salt FROM passwords WHERE id=?");
	$stmt->execute(array($studentid));	
	$res=$stmt->get_result();
	$row=$res->fetch_assoc();
	$salt=$row['salt'];
	$hashedpass=hashsalt($enteredcode,$salt);
	$stmt = $db->prepare("SELECT COUNT(*) AS num_matches FROM passwords WHERE id=? AND password=?");
	$stmt->execute(array($studentid, $hashedpass));
	$response=$stmt->fetch();
	if($response['num_matches']>0){
		echo "Authentication successful.";
	}
	else{
		header('Location: /code.php');
	}
}
else{
	header('Location: /code.php');
}
?>
