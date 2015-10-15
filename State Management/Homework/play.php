<?php
	session_start();
	if (!isset($_SESSION['name']) || (isset($_POST['name']) && $_POST['name'] != $_SESSION['name'])) {
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['randomNumber'] = rand(0, 100);
	}
	if (!$_SESSION['name']) {
		header('Location: ' . 'index.php');
	}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Play</title>
</head>
<body>
	<form method="post">
		<input type="number" min="0" , max="100" name="number"/>
		<input type="submit" value="Try"/>
	</form>
	<h2>
		<?php
		if (isset($_POST["number"])) {
			$number = (int)$_POST["number"];
			if (is_int($number)) {
				if ($number > 0 || $number < 100) {	
					if($number > $_SESSION["randomNumber"]) {
						echo "Down";
					}
					if($number < $_SESSION["randomNumber"]) {
						echo "Up";
					}
					if($number === $_SESSION["randomNumber"]) {
						echo "Congratulations, ".$_SESSION["name"];
						$_SESSION['randomNumber'] = rand(0, 100);
						echo '<form method="get" action="index.php">
							<input type="submit" value="Play again" />
						</form>';
						session_destroy();
					}
				}
				else {
					echo "Please enter a number in range [0;100]";
				}
			}
			else {
				echo "Please enter a number";
			}
		}
		?>
	</h2>


</body>
</html>