<?php
session_start();
include_once 'db.inc.php';
include_once 'functions.inc.php';
if($_SESSION['logged_in']!=true){
	header('Location:/index.php');
	exit;
}

if(!isset($_SESSION['current_vote']) || $_SESSION['current_vote']==""){
	header('Location: /vote.php');
	exit;
}
else{
	
	$db=new PDO(DB_INFO,DB_USER,DB_PASS);
	$sel_cand_id=htmlentities($_POST['choice']);
	$curr_position=htmlentities($_SESSION['current_vote']);
	$studentid=htmlentities($_SESSION['studentid']);
	$sql = 'INSERT INTO votes (studentid, candidateid, position) VALUES (?, ?, ?)';
	$stmt=$db->prepare($sql);
	$stmt->execute(array($studentid,$sel_cand_id,$curr_position));
	$stmt->closeCursor();
	$_SESSION['current_vote']="";
	array_shift($_SESSION['app_positions']);
	header('Location: /vote.php');
	
	
}
?>