<html>
	<head>SGA Election Login</head>//hello
	<body>
		<h1>Login</h1></br>
		<h3>Make sure you got a password from <a href="www.elections.mbhs.edu/passgen.php">The password generator</a>.</h3>
		<form method="post">
			<lable for="id">ID number (without the year)</lable>
				<input type="text" id="id"></br>
			<lable for="password">Password</lable>
				<input type="text" id="password"></br>
			<input type="button" value="Login">
		</form>
		<?php
		//Compare id and password values with server
		//If they're the same, allow login

		//Else give an error
		?>
	</body>
</html>
