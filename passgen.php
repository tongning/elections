<html>
        <head>Password generation for SGA Elections</head>
        <body>
                <h1>Password Generator for SGA elections</h1>
                </br>
                <form method="post">
                        <lable for="name">Voter's Last Name </lable>
                                <input type="text" id="name"></br>
                        <lable for="id">Voter id (without year #)</lable>
                                <input type="text" id="id"></br>
                        <input type="submit" value="Send">
                </form>
		<?php
		//compare id and name to server values

		//if they match, hash the id w/ salt and date/time
		//return this as the password and update it in the server
		
		//if the name/id don't match, cry, give an error
		?>
        </body>
</html>
