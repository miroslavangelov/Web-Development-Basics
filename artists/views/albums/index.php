<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Year</th>
		<th>Artist</th>
	</tr>
	<?php 
		foreach ($albums as $album) {

			echo "<tr>";
				echo '<td>'.$album["id"].'</td>';
				echo '<td>'.$album["name"].'</td>';
				echo '<td>'.$album["year"].'</td>';
				echo '<td>'.$album["artist_id"].'</td>';
			echo "</tr>";
		}
	?>
</table>

