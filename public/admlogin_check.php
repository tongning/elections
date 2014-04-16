<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include_once 'functions.inc.php';
include_once 'db.inc.php';
/*$password="sga2014907";*/
if($_SERVER['REQUEST_METHOD']=='POST'
	&& !empty($_POST['username'])
	&& !empty($_POST['password'])){
	
	$user=htmlentities($_POST['username']);
	$pass=htmlentities($_POST['password']);
	$db = new PDO(DB_INFO, DB_USER, DB_PASS);
	$sql="SELECT salt
	FROM admins
	WHERE username=?";
	$stmt=$db->prepare($sql);
	$stmt->execute(array($user));
	$e=$stmt->fetchAll();
	
	$salt="";
	foreach($e as $currsalt){
		$salt=$currsalt['salt'];
	}
	
	$stmt=$db->prepare("SELECT COUNT(*) AS num_match FROM admins  WHERE username=? && password=?");
	$password=hashsalt($pass,$salt);
	$stmt->execute(array($user, $password));
	$response=$stmt->fetch();
	if($response['num_match']==1){
		echo "Authentication successful";
		$_SESSION['is_admin']=1;
		header('Location:/admhome.php');
	}
	else{
		header('Location:/admlogin.php');
	}
	
}
else{
	header('Location:/admlogin.php');
}




?>