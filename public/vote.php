<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once 'functions.inc.php';
include_once 'db.inc.php';
session_start();
$link=new PDO(DB_INFO,DB_USER,DB_PASS);
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
	$studentid=htmlentities($_SESSION['studentid']);
	$username=$_SESSION['billusername'];
	$sql="SELECT grade FROM students WHERE id=? LIMIT 1";
	$stmt=$link->prepare($sql);
	$votergrade="";
	if($stmt->execute(array($studentid))){
		while($row=$stmt->fetch()){
			$votergrade=$row['grade'];
		
		
		}
	
	
	}
	
	if(!$_SESSION['startedvoting']){
		$applicable_positions=array();
		
		$_SESSION['startedvoting']=true;
		/*voting process has just begun.  start by determining which positions this voter can vote for.*/
		//$votergrade=mysql_real_escape_string($votergrade);
		
		/*pdo doesn't support variable column names.  construct the query manually.  some sanitizing needed.*/
		$sql='SELECT position_title FROM positions WHERE gr'.$votergrade.'=1';
		
		$stmt=$link->prepare($sql);
		if($stmt->execute()){
			
			while($row=$stmt->fetch()){
				
				array_push($applicable_positions,$row['position_title']);
				
			}
		}
		//store list of positions this voter can vote for as a session cookie
		$_SESSION['app_positions']=$applicable_positions;
		print_r($applicable_positions);
		//refresh page
		header('Location:/vote.php');
	}
	else {
		//user has already begun voting, and the list of positions is already set in session cookie
		//add code to display voting form
		if(count($_SESSION['app_positions'])==0){

			header('Location: /confirm.php');
			exit;
		}
		$_SESSION['current_vote']=$_SESSION['app_positions'][0];
		echo '<h1>Vote for ';
		echo $_SESSION['app_positions'][0];
		echo '</h1>';
		echo '
			<form action="countvote.php" method="post">
		';
		$sql='SELECT candidateid, firstname, lastname FROM candidates WHERE position_title=?';
		$stmt=$link->prepare($sql);
		if($stmt->execute(array($_SESSION['app_positions'][0]))){
			while($row=$stmt->fetch()){
				echo '<input type="radio" name="choice" value="'.$row['candidateid'].'" >'.$row['firstname'].' '.$row['lastname'].'<br>';
		
		
			}
	
	
		}
		echo '<input type="submit" value="continue">';
		echo '</form>';
		
	}
	



}
else{
	header('Location:/voterlogin.php');
}


?>