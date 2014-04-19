<html>
<head>
  <meta charset="utf-8">
  <meta name = "author" content = "Caitlyn Singam (front end design)">
  <!-- name this make! -->
  
  <!-- styling -->
  <link href="http://fonts.googleapis.com/css?family=Overlock|Lily+Script+One|Oxygen|Questrial|Cutive+Mono" rel="stylesheet" type="text/css">
  <style type="text/css">
   html { 
      height: 100%; 
    }

   /* Sets the background for the page */
   body {
    /* change this image to change your backgroud*/
    background-image: url("http://www.desktopwallpaperhd.net/wallpapers/6/7/nature-light-background-wallpaper-computers-desktop-60007.jpg");
    background-color: rgb(160, 230, 95);
    background-size: 100% 100%;
    background-position: center;
    background-attachment: scroll;
    background-repeat: no-repeat;
    overflow-x: hidden;
    overflow-y: hidden;
    bottom:9em;
  }
    
#image1{
    position: absolute;
    bottom: 29em;
    left: 16%;
    width: 6em;
}

#image2{
    border: 2pt solid green;
    position: absolute;
    bottom: 28em;
    left: 75%;
    width: 11em;
}
    
#SGA{
    position: absolute;
    font-family: Lily Script One;
    color: red;
    bottom: 11.5em !important;
    left: -2em !important;
    padding: 10px 10px 10px 175px;
    font-size:40px;
}
#header{
   font-family: Oxygen;
   color: green;
   margin: 10px;
   position: absolute;
   max-width: 1000px;
   padding: 10px 10px 10px 200px;
   left: 20em;
}
#instructions{
    font-family:Overlock;
    margin: 5%;
    position: absolute;
    max-width: 100%;
    bottom: 13em;
    font-size:20px;
}
#input{
    font-family:Overlock;
    margin: 5%;
    position: absolute;
    max-width: 100%;
    bottom: 10em;
    font-size:20px;
}

#admin{
    font-family: "Cutive Mono";
    font-size: 4pt;
    color: gray;
    margin: 10px;
   	position: absolute;
   	max-width: 1000px;
   	padding: 10px 10px 10px 200px;
   	left: 190em;
    bottom: 0em;
}  
.css3button {
  font-family: "Questrial";
  color: #294CFF !important;
  font-size: 14px;
  position: absolute;
  font-size:20px;
  box-shadow:
		-5px 4px 2px rgba(000,000,000,0),
		inset 2px -4px 8px rgba(010,247,113,0.7);
  text-shadow:
		-1px -1px 0px rgba(000,000,000,0.3),
		1px 1px 1px rgba(255,255,255,0.2);
  padding: 8px 7px;
  -moz-border-radius: 11px;
  -webkit-border-radius: 11px;
  border-radius: 11px;
  border: 2px double #D30068;
  background: #63B8EE;
  background: linear-gradient(top,  #9BEE1F,  #A1E693);
  background: -ms-linear-gradient(top,  #9BEE1F,  #A1E693);
  background: -webkit-gradient(linear, left top, left bottom, from(#9BEE1F), to(#A1E693));
  background: -moz-linear-gradient(top,  #9BEE1F,  #A1E693);
  bottom: 8em;
  left:4em
}
.css3button:hover {
  color: #14396A !important;
  background: #468CCF;
  background: linear-gradient(top,  #32D948,  #44BD4C);
  background: -ms-linear-gradient(top,  #32D948,  #44BD4C);
  background: -webkit-gradient(linear, left top, left bottom, from(#32D948), to(#44BD4C));
  background: -moz-linear-gradient(top,  #32D948,  #44BD4C);
}
  </style>
</head>
<body>
<div id="SGA">
<h1>SGA</h1>
</div>
<br><br><br><br><br>
<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
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
	exit;
}


?>
</body>

</html>
