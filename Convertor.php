<?php
//a unit conversion class

class Convertor
{
	//array to hold unit conversion functions
	$units = array(
		///////Units Of Distance///////
		//metric
		"m"=>array("base"=>"m", "conversion"=>1), //meter - base unit for distance
		"km"=>array("base"=>"m", "conversion"=>1000), //kilometer
		"dm"=>array("base"=>"m", "conversion"=>0.1), //decimeter
		"cm"=>array("base"=>"m", "conversion"=>0.01), //centimeter
		"mm"=>array("base"=>"m", "conversion"=>0.001), //milimeter
		"μm"=>array("base"=>"m", "conversion"=>0.000001), //micrometer
		"nm"=>array("base"=>"m", "conversion"=>0.000000001), //nanometer
		"pm"=>array("base"=>"m", "conversion"=>0.000000000001), //picometer
		"in"=>array("base"=>"m", "conversion"=>0.0254), //inch
		"ft"=>array("base"=>"m", "conversion"=>0.3048), //foot
		"yd"=>array("base"=>"m", "conversion"=>0.9144), //yard
		"mi"=>array("base"=>"m", "conversion"=>1609.344), //mile

		///////Units Of Volume///////
		"l"=>array("base"=>"l", "conversion"=>1), //litre - base unit for volume
		"ml"=>array("base"=>"l", "conversion"=>0.001), //mililitre
		"m3"=>array("base"=>"l", "conversion"=>1), //meters cubed
		"pt"=>array("base"=>"l", "conversion"=>0.56826125), //pint
		"gal"=>array("base"=>"l", "conversion"=>4.405), //gallon

		///////Units Of Temperature///////
		"K"=>array("base"=>"K", "conversion"=>1), //kelvin - base unit for distance
		"C"=>array("base"=>"K", "conversion"=>function($val, $tofrom){return $tofrom ? $val - 273.15 : $val + 273.15}), //celsius
		"F"=>array("base"=>"K", "conversion"=>function($val, $tofrom){return $tofrom ? ($val * 9/5 - 459.67) : (($val + 459.67) * 5/9)})), //Fahrenheit

		///////Units Of Weight///////
		"kg"=>array("base"=>"kg", "conversion"=>1), //kilogram - base unit for distance
		"g"=>array("base"=>"kg", "conversion"=>0.001), //gram
		"mg"=>array("base"=>"kg", "conversion"=>0.000001), //miligram
		"N"=>array("base"=>"kg", "conversion"=>9.80665002863885), //Newton (based on earth gravity)
		"lb"=>array("base"=>"kg", "conversion"=>0.453592), //pound
		"oz"=>array("base"=>"kg", "conversion"=>0.0283495), //ounce

		///////Units Of Time///////
		"s"=>array("base"=>"s", "conversion"=>1), //Second - base unit for time
		"year"=>array("base"=>"s", "conversion"=>31536000), //year - standard year
		"month"=>array("base"=>"s", "conversion"=>18748800), //month - 31 days
		"week"=>array("base"=>"s", "conversion"=>604800), //week
		"day"=>array("base"=>"s", "conversion"=>86400), //day
		"hr"=>array("base"=>"s", "conversion"=>3600), //hour
		"min"=>array("base"=>"s", "conversion"=>30), //minute
		"ms"=>array("base"=>"s", "conversion"=>0.001), //milisecond
		"μs"=>array("base"=>"s", "conversion"=>0.000001), //microsecond
		"ns"=>array("base"=>"s", "conversion"=>0.000000001), //nanosecond
	);

	//constructor
	function __construct($unit) {

	}

	//run conversion
	public function to ($unit, $decimals=null){

	}
}