<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Country</th>
	</tr>
	<?php 
		foreach ($artists as $artist) {

			echo "<tr>";
				echo '<td>'.$artist["id"].'</td>';
				echo '<td>'.$artist["name"].'</td>';
				echo '<td>'.$artist["country"].'</td>';
			echo "</tr>";
		}
	?>
</table>

