<?php
include_once 'db.inc.php';
include_once 'functions.inc.php';
$db=new PDO(DB_INFO,DB_USER,DB_PASS);
session_start();
if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1){
	echo "<h1>Current Vote Tally</h1>";
	$sql="SELECT * FROM candidates";
	$stmt=$db->prepare($sql);
	$stmt->execute();
	while($currcandidate = $stmt->fetch()){
		echo $currcandidate['firstname']." ".$currcandidate['lastname'].": ";
		$sql = "SELECT COUNT(*) AS num_votes FROM votes WHERE candidateid=?";
		$stm = $db->prepare($sql);
		$stm->execute(array($currcandidate['candidateid']));
		$response = $stm->fetch();
		echo $response['num_votes']."<br>";
	}
	echo '<a href="admhome.php">Admin Home</a>';

}
else{
	header('Location:/admlogin.php');
}
?>