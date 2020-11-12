<?php
$height = 5;
$width = 10;

$table = [];

for ($i = 0; $i < $height; ++$i) {
	for ($j = 0; $j < $width; ++$j) {
		$table[$i][] = rand(0, 9);
	}
}
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<style>
		.container {
			width: 400px;
		}
	</style>
</head>

<body style="padding-top: 3rem;">
	<div class="container">
		<table class="striped centered">
			<?php foreach ($table as $j) : ?>
				<tr>
					<?php foreach ($j as $i) : ?>
						<td><?php echo $i ?></td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
		</table>
	</div>

</body>

</html>