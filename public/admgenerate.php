<!DOCTYPE html>
<head>
<title>SGA Election Login</title>
</head>
<body>
<h2>SGA Elections 2014</h2>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
if($_SERVER['REQUEST_METHOD']=='POST'
	&& !empty($_POST['idnum'])
	//&& !empty($_POST['lastname']) commented out for name-verify scheme
	){
		
$id=htmlentities($_POST['idnum']);
//$name=htmlentities($_POST['lastname']);

include_once 'db.inc.php';
include_once 'functions.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);


$stmt = $db->prepare("SELECT COUNT(*) AS num_users FROM students  WHERE id=?");
//AND lastname=?");
$stmt->execute(array($id)); //,$name));
$response=$stmt->fetch();

if($response['num_users']>0){
	/*Check if this user has already generated a password*/
	$stmt=$db->prepare("SELECT COUNT(*) AS pass_matches FROM passwords WHERE id=?");
	$stmt->execute(array($id));
	$response=$stmt->fetch();
	/*If user has not yet generated a password*/
	if($response['pass_matches']==0){
		$smtm=$db->prepare("SELECT firstname, lastname FROM students WHERE id=?");
		
		$smtm->execute(array($id));
		$e=$smtm->fetchAll();
		$fname="";
		$lname="";
		foreach($e as $currperson){
			$fname=$currperson['firstname'];
			$lname=$currperson['lastname'];
		}
		$fname=htmlentities($fname);
		$lname=htmlentities($lname);
		$name = $fname." ".$lname;	
		echo "<p>According to the student records, ID ".$id." is:</p>";
		echo "<h1>".$name."</h1><br>";
//		echo "Welcome, ".$name;
//		echo "<br>";
		
		echo "Verify that the voter is ".$name." before giving them the card<br>"; //this line doesn't work for some reason

		/*echo "Your id is ".$id.".<br>";*/
		/*generate password*/
		$password=myRand(1000000000);
		$salt=time();
		$hash=hashsalt($password,$salt);
		echo("<font color='#FF0000'>If the name is correct, write the following code onto the voter's card:</font><br>");
		echo "<h1><strong>Code: ".$password."</strong></h1><br><a href='admcodes.php'>Next voter</a>";
		$stmt=$db->prepare("INSERT INTO passwords (id, password,salt) VALUES (?, ?, ?)");
		$stmt->execute(array($id,$hash,$salt));
	}
	else{
		echo("<p>Error: A code has already been generated for this user.</p>");	
	}
}
else{
	echo("The ID you entered is invalid.");
}
}
else{
header('Location: /admhome.php');	
	}

?>
<br>
<a href="http://elections.mbhs.edu/admhome.php">Admin Home</a>
</body>
</html>
