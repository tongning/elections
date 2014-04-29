<!DOCTYPE html>
<head>
<title>SGA Elections 2014</title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1){
header('Location: /admhome.php');
}
else{
echo "
<h3>Administrator Login</h3>
<p>Enter an administrator username and password below.</p>
<form name='admlogin' action='admlogin_check.php' method='POST'>
Username: <input type='text' name='username'><br>
Password: <input type='password' name='password'><br>
<input type='submit' value='submit'>
</form>
";
}
?>
</body>
</html>




