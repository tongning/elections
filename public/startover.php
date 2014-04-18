
<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 4/17/14
 * Time: 8:22 PM
 */
session_start();
include_once 'db.inc.php';
include_once 'functions.inc.php';
$db=new PDO(DB_INFO,DB_USER,DB_PASS);
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && isset($_SESSION['studentid'])){
    $stuid=htmlentities($_SESSION['studentid']);
    $sql="DELETE FROM votes WHERE studentid=?";
    $stmt=$db->prepare($sql);
    $stmt->execute(array($stuid));
    session_destroy();
    session_start();
    $_SESSION['studentid']=$stuid;
    $_SESSION['logged_in']=true;
    header('Location:vote.php');
}
else{
    header('Location:index.php');
}
?>