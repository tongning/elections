<!DOCTYPE html>
<head>

    <title>Reset Voter Account</title>
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include_once 'functions.inc.php';
include_once 'db.inc.php';
$db=new PDO(DB_INFO,DB_USER,DB_PASS);
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 4/17/14
 * Time: 5:10 PM
 */
if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1){
    if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['conf']=='confirmed'){
        $stuid=htmlentities($_POST['stuid']);
        $sql="DELETE FROM votes WHERE studentid=?";
        if($stmt = $db->prepare($sql)){
            $stmt->execute(array($stuid));
            $stmt->closeCursor();
            echo 'Votes cleared.<br><a href="admhome.php">Admin Home</a>';

        }
    }
    else if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['conf']=='unconfirmed'){
        echo 'Are you sure you want to clear all votes by voter '.htmlentities($_POST['stuid']).'?<br>';
        echo '
             <form name="clearvotes" action="admreset.php" method="post">
             <input type="hidden" value="confirmed" name="conf">
             <input type="hidden" name="stuid" value="
        ';
        echo htmlentities($_POST['stuid']).'">';
        echo '<input type="submit" value="Confirm">';
        echo '</form>';
    }
    else{
        echo '
        <h2>Reset Voter Account</h2>
        Reset a voter account to allow a voter to vote a second time.  Any existing votes will be cleared.
        <form name="clearvotes" action="admreset.php" method="post">
        Student ID:<input type="text" name="stuid"><br>
        <input type="hidden" value="unconfirmed" name="conf">
        <input type="submit" value="Submit">
        </form>
        <a href="admhome.php">Admin Home</a>
        ';
    }
}
else{
    header('Location:admlogin.php');
}


?>
</body>
</html>