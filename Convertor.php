<?php
//a unit conversion class

class Convertor
{
	private $value = null; //value to convert
	private $baseUnit = false; //base unit of value

	//array to hold unit conversion functions
	private $units = array();

	function defineUnits(){
		$this->units = array(
		///////Units Of Length///////
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

		///////Units Of Area///////
		"m2"=>array("base"=>"m2", "conversion"=>1), //meter square - base unit for area
		"km2"=>array("base"=>"m2", "conversion"=>1000000), //kilometer square
		"cm2"=>array("base"=>"m2", "conversion"=>0.0001), //centimeter square
		"mm2"=>array("base"=>"m2", "conversion"=>0.000001), //milimeter square
		"ft2"=>array("base"=>"m2", "conversion"=>0.092903), //foot square
		"mi2"=>array("base"=>"m2", "conversion"=>2589988.11), //mile square
		"ac"=>array("base"=>"m2", "conversion"=>4046.86), //acre
		"ha"=>array("base"=>"m2", "conversion"=>10000), //hectare

		///////Units Of Volume///////
		"l"=>array("base"=>"l", "conversion"=>1), //litre - base unit for volume
		"ml"=>array("base"=>"l", "conversion"=>0.001), //mililitre
		"m3"=>array("base"=>"l", "conversion"=>1), //meters cubed
		"pt"=>array("base"=>"l", "conversion"=>0.56826125), //pint
		"gal"=>array("base"=>"l", "conversion"=>4.405), //gallon

		///////Units Of Weight///////
		"kg"=>array("base"=>"kg", "conversion"=>1), //kilogram - base unit for weight
		"g"=>array("base"=>"kg", "conversion"=>0.001), //gram
		"mg"=>array("base"=>"kg", "conversion"=>0.000001), //miligram
		"N"=>array("base"=>"kg", "conversion"=>9.80665002863885), //Newton (based on earth gravity)
		"st"=>array("base"=>"kg", "conversion"=>6.35029), //stone
		"lb"=>array("base"=>"kg", "conversion"=>0.453592), //pound
		"oz"=>array("base"=>"kg", "conversion"=>0.0283495), //ounce

		//////Units Of Speed///////
		"mps"=>array("base"=>"mps", "conversion"=>1), //meter per seond - base unit for speed
		"kph"=>array("base"=>"mps", "conversion"=>0.44704), //kilometer per hour
		"mph"=>array("base"=>"mps", "conversion"=>0.277778), //kilometer per hour

		///////Units Of Temperature///////
		"k"=>array("base"=>"k", "conversion"=>1), //kelvin - base unit for distance
		"c"=>array("base"=>"c", "conversion"=>function($val, $tofrom){return $tofrom ? $val - 273.15 : $val + 273.15;}), //celsius
		"f"=>array("base"=>"f", "conversion"=>function($val, $tofrom){return $tofrom ? ($val * 9/5 - 459.67) : (($val + 459.67) * 5/9);}), //Fahrenheit

		///////Units Of Pressure///////
		"pa"=>array("base"=>"Pa", "conversion"=>1), //Pascal - base unit for Pressure
		"kpa"=>array("base"=>"Pa", "conversion"=>1000), //kilopascal
		"mpa"=>array("base"=>"Pa", "conversion"=>1000000), //megapascal
		"bar"=>array("base"=>"Pa", "conversion"=>100000), //bar
		"mbar"=>array("base"=>"Pa", "conversion"=>100), //milibar
		"psi"=>array("base"=>"Pa", "conversion"=>6894.76), //pound-force per square inch

		///////Units Of Time///////
		"s"=>array("base"=>"s", "conversion"=>1), //second - base unit for time
		"year"=>array("base"=>"s", "conversion"=>31536000), //year - standard year
		"month"=>array("base"=>"s", "conversion"=>18748800), //month - 31 days
		"week"=>array("base"=>"s", "conversion"=>604800), //week
		"day"=>array("base"=>"s", "conversion"=>86400), //day
		"hr"=>array("base"=>"s", "conversion"=>3600), //hour
		"min"=>array("base"=>"s", "conversion"=>30), //minute
		"ms"=>array("base"=>"s", "conversion"=>0.001), //milisecond
		"μs"=>array("base"=>"s", "conversion"=>0.000001), //microsecond
		"ns"=>array("base"=>"s", "conversion"=>0.000000001), //nanosecond

		///////Units Of Power///////

		/


		///////Units Of Angle///////

		///////Units Of Energy///////
		);
}

	//constructor
	function __construct($value, $unit) {//

		$this->defineUnits();

		//unit optional
		if(!is_null($value)){
			$this->from($value, $unit);
		}

	}

	//set initial value again
	public function from($value, $unit) {
		//unit optional

		if(is_null($value)){
			throw new Exception("Value Not Set");
		}

		if($unit){
			if(array_key_exists($unit, $this->units)){
				$unitLookup = $this->units[$unit];

				$this->baseUnit = $unitLookup["base"];
				$this->value = $this->convertToBase($value, $unitLookup);
			}else{
				throw new Exception("Unit Does Not Exist");
			}
		}else{
			$this->value = $value;
		}
	}

	//run conversion to new unit
	public function to($unit, $decimals=null, $round=true){
		//if no unit set in constructor workout base unit of to function
		//if no decimals set return whole result

		if(is_null($this->value)){
			throw new Exception("From Value Not Set");
		}

		if(!$unit){
			throw new Exception("Unit Not Set");
		}

		if(is_array($unit)){
			return $this->toMany($unit, $decimals, $round);
		}else{

			if(array_key_exists($unit, $this->units)){
				$unitLookup = $this->units[$unit];

				$result = 0;

				//if from unit not provided, asume base unit of to unit type
				if($this->baseUnit){
					if($unitLookup["base"] != $this->baseUnit){
						throw new Exception("Cannot Convert Between Units of Different Types");
					}
				}else{
					$this->baseUnit = $unitLookup["base"];
				}

				//calculate value
				if(is_callable($unitLookup["conversion"])){
					$result = $unitLookup["conversion"]($this->value, true);
				}else{
					$result = $this->value / $unitLookup["conversion"];
				}

				//sort decimal rounding etc.
				if(!is_null($decimals)){
					if($round){
						$result = round($result, $decimals); //round to the specifidd number of decimals
					}else{
						$shifter = $decimals ? pow(10, $decimals) : 1;
						$result = floor($result * $shifter) / $shifter; //truncate to the nearest number of decimals
					}
				}

				return $result;
			}else{
				throw new Exception("Unit Does Not Exist");
			}
		}
	}

	//returns an array of conversion to all units with matching base units
	public function toAll($decimals=null, $round=true){

		if(is_null($this->value)){
			throw new Exception("From Value Not Set");
		}

		if($this->baseUnit){

			$unitList = array();

			foreach ($this->units as $key => $values) {
				if($values["base"] == $this->baseUnit){
					array_push($unitList, $key);
				}
			}

			return $this->toMany($unitList, $decimals, $round);

		}else{
			throw new Exception("No From Unit Set");
		}

	}

	//return multiple conversions
	private function toMany($unitList = [], $decimals=null, $round=true){

		$resultList = array();

		foreach ($unitList as $key) {
			$resultList[$key] = $this->to($key, $decimals, $round);
		}

		return $resultList;

	}

	//add conversion unit
	public function addUnit($unit, $base, $conversion){
		//throw new Exception('Base Unit Does Not Exist");

		if(array_key_exists($unit, $this->units)){
			throw new Exception("Unit Already Exists");
		}else{
			if(!array_key_exists($base, $this->units) && $base != $unit){
				throw new Exception("Base Unit Does Not Exist");
			}else{
				$this->units[$unit] = array("base"=>$base, "conversion"=>$conversion);
			}
		}

	}

	//returns and array of units available for given unit, empty value returns all units
	public function getUnits($unit){
		if(array_key_exists($unit, $this->units)){
			$baseUnit = $this->units[$unit]["base"];

			$unitList = array();

			foreach ($this->units as $key => $values) {
				if($values["base"] == $baseUnit){
					array_push($unitList, $key);
				}
			}

			return $unitList;
		}else{
			throw new Exception("Unit Does Not Exist");
		}
	}

	//convert value to base unit
	private function convertToBase($value, $unitArray){

		if(is_callable($unitArray["conversion"])){
			return $unitArray["conversion"]($value, false);
		}else{
			return $value * $unitArray["conversion"];
		}
	}
}