	<form method="POST">
		<label>Name:</label>
		<input type="text" name="name" value="<?php echo addslashes($artist["name"]);?>"/>
		<label>Country:</label>
		<input type="text" name="country" value="<?php echo addslashes($artist["country"]);?>"/>
		<input type="hidden" name="id" value="<?php echo $artist["id"];?>" />
		<input type="submit" />
	</form>

