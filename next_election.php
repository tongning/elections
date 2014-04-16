<html>
	<head><title>Ballot for <?php echo "election name" ?></title></head>
	<body>
		<h1>Ballot for <?php echo "election name" ?></h1>
		<form method="post">
		<table>
		<?php for($i=1;$i<=5;$i++){ ?> 
			<tr>
				<td><img src=""></td>
				<td><?php echo "Candidate Name" ?></td>
				<td><input type="radio" name="candidate" value="<?php echo "Candidate Name" ?>" ></td>
			</tr>
		<?php } ?>
		</table>
		<input type="submit" value="Vote" />	
	</body>
</html>
