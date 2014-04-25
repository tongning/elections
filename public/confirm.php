<!DOCTYPE html>
<head>
    <title>Confirm Selections - SGA Elections 2014</title>
</head>
<body>
<h2>Confirm your selections</h2>
<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 4/17/14
 * Time: 7:54 PM
 */
session_start();
include_once 'db.inc.php';
include_once 'functions.inc.php';
$db=new PDO(DB_INFO,DB_USER,DB_PASS);
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && isset($_SESSION['studentid'])){
    $stuid=htmlentities($_SESSION['studentid']);
    if($_SERVER['REQUEST_METHOD']!='POST'){

        $sql="SELECT candidateid FROM votes WHERE studentid=?";
        $stmt=$db->prepare($sql);
        $stmt->execute(array($stuid));
        while($selection = $stmt->fetch()){
            $currcandid=$selection['candidateid'];
            $sql="SELECT position_title, firstname, lastname FROM candidates WHERE candidateid=? LIMIT 1";
            $stm=$db->prepare($sql);
            $stm->execute(array($currcandid));
            while($candidate = $stm->fetch()){
                echo '<br>';
                echo $candidate['position_title'];
                echo '<br>';
                echo $candidate['firstname']." ".$candidate['lastname'];
            }
        }
        echo '
        <form name="confirm" action="confirm.php" method="post">
        <input type="hidden" value="conf" name="confirm">
        <input type="submit" value="Confirm Selections">
        </form>
        <p>If any of these selections are not correct, click <a href="startover.php">here</a> to start over.</p>
        ';
    }
    else{
        if($_POST['confirm']=='conf'){
            $sql="UPDATE votes SET finalized=1 WHERE studentid=?";
            $stmt=$db->prepare($sql);
            $stmt->execute(array($stuid));
            $stmt->closeCursor();
			//clear ID numbers for anonymous voting
			//first record that user has voted
			$sql="UPDATE students SET voted=1 WHERE id=?";
			$stmt=$db->prepare($sql);
			$stmt->execute(array($stuid));
			$stmt->closeCursor();
			
            session_destroy();
            header('Location:done.php');
			//now clear student IDs
			$sql="UPDATE votes SET studentid=0 WHERE studentid=?";
			$stmt=$db->prepare($sql);
			$stmt->execute(array($stuid));
			$stmt->closeCursor();
        }
    }

}
else{
    header('Location:/index.php');
    exit;
}


?>
</body>
</html>