
Convertor
================================

An easy to use PHP unit conversion library

Converter allows you to convert any unit to any other compatible unit type

It has no external dependencies, simply include the library in your project and you're away!

Convertor can handle a wide range of unit types including:
<ul>
	<li>Length</li>
	<li>Volume</li>
	<li>Weight</li>
	<li>Temperature</li>
	<li>Pressure</li>
	<li>Time</li>
</ul>

See [Available Units](#available-units) for full list of units in Convertor.

If these are not the units you are looking for then it is easy to add your own.


Setup
================================
Setting up Convertor could not be simpler.

Include the library
```php
include("Convertor.php");
```

Simple Example
================================

Once you have included the Converter.php library, creating conversions is as simple as creating an instance of the Convertor with the value to convert from, then specifying the new units

```php
$simpleConvertor = new Convertor(10, "m");
$simpleConvertor->to("ft"); //returns converted value
```
10 Meters = 32.808398950131 Feet

Covert to Multiple Units
================================
Once you have setup your Convertor instance you can convert the same value into multiple units by calling the to function multiple times

```php
$multiunitConvertor = new Convertor(10, "m");
$multiunitConvertor->to("km"); //returns converted value in kilometers
$multiunitConvertor->to("ft"); //returns converted value in feet
```
10 Meters:
- km - 0.01
- cm - 1000
- mm - 10000
- mi - 0.0062137119223733
- yd - 10.936132983377
- ft - 32.808398950131


An alternative way to convert multiple units at once is to pass an array of units to the to() function:
```php
$multiunitConvertor->to(["km","ft","in"]); //returns an array of converted values in kilometers, feet and inches
```

The result of the above function would be
```js
{
    "km": 0.01,
    "ft": 32.808398950131,
    "in": 393.70078740157
}
```



Convert to All Compatible Units
================================
You can convert a value to all compatible units using the toAll() function
```php
$AllUnitsConvertor = new Convertor(10, "m");
$AllUnitsConvertor->toAll(); //returns all compatible converted value
```

This will return an array containing the conversions for all compatible units, in the case of "meters" as a start unit, Convertor will return all available distance units

```js
{
    "m": 10,
    "km": 0.01,
    "dm": 100,
    "cm": 1000,
    "mm": 10000,
    "μm": 10000000,
    "nm": 10000000000,
    "pm": 10000000000000,
    "in": 393.70078740157,
    "ft": 32.808398950131,
    "yd": 10.936132983377,
    "mi": 0.0062137119223733
}
```



List All Available Units
================================
You can generate a list of all compatible units using the getUnits() function.
```php
$getUnitsConvertor = new Convertor();
$getUnitsConvertor->getUnits("m"); //returns converted value
```

This will return an array of all available units compatible with the specified unit:
```js
[
    "m",
    "km",
    "dm",
    "cm",
    "mm",
    "μm",
    "nm",
    "pm",
    "in",
    "ft",
    "yd",
    "mi"
]
```

Change From Value
================================
You can change the value and unit you are converting from at any point using the from() function.
```php
$fromChangeConvertor = new Convertor(10,"m");
$fromChangeConvertor->to("ft"); //returns converted value in feet
$fromChangeConvertor->from(5.23,"km"); //sets new from value in new unit
$fromChangeConvertor->to("mi"); //returns converted new value in miles
```

10 Meters = 32.808398950131 Feet


5.23 Kilometers = 3.2497713354013 Miles


Result Precision
================================
The precision of the results can be set using two optional paramerters in the to() function to specify the decimal precision and use of rounding.
```php
$precisionConvertor->to("ft",4,true);
```
The second parameter specifies the decimal precision of the result, the thir parameter indicates weather the result syhould be rounded (true, default value) or truncated (false).

10 Meters = 32.8084 Feet (rounded to 4 decimal places)


Available Units
================================


###Distance
- m - Meter
- km - Kilometer
- dm - Decimeter
- cm - Centimeter
- mm - Milimeter
- μm - Micrometer
- nm - Nanometer
- pm - Picometer
- in - Inch
- ft - Foot
- yd - Yard
- mi - Mile

###Volume
- l - Litre
- ml - Mililitre
- m3 - Cubic Meter
- pt - Pint
- gal - Galon

###Weight
- kg - Kilogram
- g - Gram
- mg - Miligram
- N - Newton *(based on earth gravity)*
- st - Stone
- lb - Pound
- oz - Ounce

###Temperature
- K - Kelvin
- C - Centigrade
- F - Fahrenheit

###Pressure
- Pa - Pascal
- bar - Bar
- mbar - Milibar

###Time
- s - Second
- year - *Year (365 days)*
- month - Month *(31 days)*
- week - Week
- day - Day
- hr - Hour
- min - Minute
- ms - Milisecond
- μs - Microsecond
- ns - Nanosecond