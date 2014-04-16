<!DOCTYPE html>

<head>
	<title>SGA Elections 2014</title>
</head>
	<body>
		<?php
		session_start();
		if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1){
		echo '
		<h1>SGA Elections 2014 - Generate Voter Codes</h1>
		<strong>Instructions:</strong>

		<p>Ask voters for their <strong>Student ID #</strong> and <strong>Full Name</strong>.  On the next page,
		verify that the name displayed matches the name stated by the voter.  If they don\'t match, <br><strong>do not continue</strong>.</p>
		<p>Once you confirm, a login code will be generated automatically.  Write the code onto index card and give the card to the voter.</p>

		<form name="login" action="admgenerate.php" method="POST">

			Student ID: <input type="text" name="idnum" size="6" maxlength="6">
		<br>

		
			<input type="submit" value="Generate Code">
			

		</form><br><a href="admhome.php">Admin Home</a><br><a href="admlogout.php">Log out admin interface</a>';
		}
		else{
			header('Location:/admlogin.php');
		}
		?>
	</body>
</html>
