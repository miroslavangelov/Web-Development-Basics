	<form method="POST">
		<label>Name:</label>
		<input type="text" name="name" value="<?php echo addslashes($album["name"]);?>"/>
		<label>Year:</label>
		<input type="text" name="year" value="<?php echo addslashes($album["year"]);?>"/>
		<input type="hidden" name="id" value="<?php echo $album["id"];?>" />
		<input type="submit" />
	</form>

