<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
	<header>
		<?php
			if (!empty($this->logged_user)) {
				echo "<div id='userbar'>Hello, {$this->logged_user['username']}!</div>";
			}
		?>
		<p>Welcome artist</p>
	</header>