<?php 
include_once 'db.inc.php';
include_once 'functions.inc.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$db = new PDO(DB_INFO,DB_USER,DB_PASS);
$next_election_array = unserialize($_COOKIE['current_races']);
$next_election = $next_election_array[0];
if ( $next_election = null){
	header();//Insert end location here
}
for ( $index = 0; $index < sizeof($next_election_array) - 1; $index++) {
	$next_election_array[$index] = $next_election_array[$index + 1];
} 
$next_election_array[sizeof($next_election_array - 1)] = null;

?>

<!doctype html>
<html>
	<head><title> <?php echo $next_election ?> </title> </head>
	<body>
		<center><h1><?php echo $next_election?> " Candidates" </h1></center></br>
		<form name="candidateselect" action="submit_vote.php" method="POST">
		<?php
			$stmt = $db->prepare('SELECT * FROM candidates WHERE position_title=?');
			$stmt->execute(array($next_election));
			$candidates = $stmt->fetchAll();
			foreach ($candidates as $candidat){
				$name = $candidate['firstname']." ".$candidate['lastname'];
				echo '<input type="radio" name="candidate" value='.$name.'>'.$name.'</br>';
			}
		?>
		<input type="submit" value="Confirm Vote">
		</form>
	</body>
</html>			
