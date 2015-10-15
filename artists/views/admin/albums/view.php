<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Year</th>
		<th>Artist</th>
	</tr>
	<?php 
			echo "<tr>";
				echo '<td>'.$album["id"].'</td>';
				echo '<td>'.$album["name"].'</td>';
				echo '<td>'.$album["year"].'</td>';
				echo '<td>'.$artist["name"].'</td>';
			echo "</tr>";
	?>
</table>