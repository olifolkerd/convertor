<?php
@include("Convertor.php");
?>

<html>
<head>
	<title>Sample Convertor Functions</title>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body>

	<style type="text/css">
	body{
		padding:20px 40px;
		font-family: 'Montserrat', sans-serif;
	}
	header{
		font-weight: bold;
		font-size: 30px;
	}

	section:first-of-type header{
		font-size: 50px;
	}

	section{
		margin-bottom:20px;
	}

	ul>li{
		margin-bottom:2px;
	}

	button{
		margin-right:20px;
	}
	</style>
	<section>
		<header>Convertor</header>

		<p>An easy to use PHP unit conversion library</p>

		<p>Converter allows you to convert any unit to any other compatible unit type</p>

		<p>It has no external dependencies, simply include the library in your project and you're away!</p>

		<p>Convertor can handle a wide range of unit types including:
			<ul>
				<li>Length</li>
				<li>Volume</li>
				<li>Temperature</li>
				<li>Weight</li>
				<li>Time</li>
			</ul>
		</p>

		<p>If these are not the units you are looking for then it is easy to add your own.</p>
	</section>

	<section>
		<header>Simple Example</header>

		<?php
			$value = 10;
			$simpleConvertor = new Convertor($value, "m");
		?>

		<p><?php echo($value); ?> Meters = <?php echo($simpleConvertor->to("ft")); ?> Feet</p>

	</section>

</body>
</html>
