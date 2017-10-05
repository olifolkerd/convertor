<?php         require 'vendor/autoload.php';

use Olifolkerd\Convertor\Convertor;
?>

<html>
<head>
	<title>Convertor - Simple PHP Unit Conversion</title>

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

	pre{
		background: #ddd;
		padding:10px;
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

		<p>once you have included the Converter.php library, creating conversions is as simple as creating an instance of the Convertor with the value to convert from, then specifying the new units</p>

		<pre>
$simpleConvertor = new Convertor(10, "m");
$simpleConvertor->to("ft"); //returns converted value</pre>

		<?php


        $simpleConvertor = new Convertor(10, "m");
		?>

		<p>10 Meters = <?php echo($simpleConvertor->to("ft")); ?> Feet</p>

	</section>

	<section>
		<header>Covert to Multiple Units</header>
		<p>Once you have setup your Convertor instance you can convert the same value into multiple units by calling the to function multiple times</p>

		<pre>
$multiunitConvertor = new Convertor(10, "m");
$multiunitConvertor->to("km"); //returns converted value in kilometers
$multiunitConvertor->to("ft"); //returns converted value in feet</pre>
		<?php
			$multiunitConvertor = new Convertor(10, "m");
		?>

		<p>10 Meters:
			<ul>
				<li>km - <?php echo($multiunitConvertor->to("km")); ?></li>
				<li>cm - <?php echo($multiunitConvertor->to("cm")); ?></li>
				<li>mm - <?php echo($multiunitConvertor->to("mm")); ?></li>
				<li>mi - <?php echo($multiunitConvertor->to("mi")); ?></li>
				<li>yd - <?php echo($multiunitConvertor->to("yd")); ?></li>
				<li>ft - <?php echo($multiunitConvertor->to("ft")); ?></li>
			</ul>
		</p>

		An alternative way to convert multiple units at once is to pass an array of units to the to() function:
		<pre>
$multiunitConvertor->to(["km","ft","in"]); //returns an array of converted values in kilometers, feet and inches</pre>

		The result of the above function would be:
		<pre><?php echo(json_encode($multiunitConvertor->to(["km","ft","in"]), JSON_PRETTY_PRINT));?></pre>
	</section>

	<section>
		<header>Convert to All Compatible Units</header>
		<p>You can convert a value to all compatible units using the toAll() function</p>
				<pre>
$AllUnitsConvertor = new Convertor(10, "m");
$AllUnitsConvertor->toAll(); //returns all compatible converted value</pre>

		<p>This will return an array containing the conversions for all compatible units, in the case of "meters" as a start unit, Convertor will return all available distance units</p>

		<?php
			$AllUnitsConvertor = new Convertor(10, "m");
		?>

		<pre><?php echo(json_encode($multiunitConvertor->toAll(), JSON_PRETTY_PRINT));?></pre>
	</section>

	<section>
		<header>List All Available Units</header>
		<p>you can generate a list of all compatible units using the getUnits() function.</p>
						<pre>
$getUnitsConvertor = new Convertor();
$getUnitsConvertor->getUnits("m"); //returns converted value</pre>

		<p>This will return an array of all available units compatible with the specified unit:</p>

		<?php
		$getUnitsConvertor = new Convertor(1,'km');
		?>

		<pre><?php echo(json_encode($getUnitsConvertor->getUnits("m"), JSON_PRETTY_PRINT));?></pre>

	</section>

	<section>
		<header>Change From Value</header>
		<p>You can change the value and unit you are converting from at any point using the from() function.</p>
		<pre>
$fromChangeConvertor = new Convertor(10,"m");
$fromChangeConvertor->to("ft"); //returns converted value in feet
$fromChangeConvertor->from(5.23,"km"); //sets new from value in new unit
$fromChangeConvertor->to("mi"); //returns converted new value in miles</pre>


		<?php
			$fromChangeConvertor = new Convertor(10, "m");
		?>

		<p>10 Meters = <?php echo($fromChangeConvertor->to("ft")); ?> Feet</p>

		<?php
			$fromChangeConvertor->from(5.23,"km");
		?>

		<p>5.23 Kilometers = <?php echo($fromChangeConvertor->to("mi")); ?> Miles</p>
	</section>

	<section>
		<header>Result Precision</header>
		<p>The precision of the results can be set using two optional paramerters in the to() function to specify the decimal precision and use of rounding.</p>
		<pre>$precisionConvertor->to("ft", 4, true);</pre>
		<p>The second parameter specifies the decimal precision of the result, the thir parameter indicates weather the result syhould be rounded (true, default value) or truncated (false).</p>

		<?php
			$precisionConvertor = new Convertor(10, "m");
		?>

		<p>10 Meters = <?php echo($precisionConvertor->to("ft", 4, true)); ?> Feet (rounded to 4 decimal places)</p>

	</section>

</body>
</html>
