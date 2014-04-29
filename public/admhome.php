<?php
session_start();
if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1){
	echo "<h1>Administrator Home</h1><h3>Tasks</h3>
	<a href='admcount.php'>Tally Votes</a><br>
	<!--<a href='admreset.php'>Reset Voter Account</a><br>
	<a href='admcodes.php'>Generate Voter Codes</a><br>-->
	<a href='admchpass.php'>Change admin password</a><br>
	<a href='admlogout.php'>Log out</a>
	
	";

}
else{
	header('Location:/admlogin.php');
}
?>