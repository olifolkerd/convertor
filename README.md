![Convertor](http://olifolkerd.github.io/convertor/images/logo.png)

An easy to use PHP unit conversion library.

Full documentation & demos can be found at: [http://olifolkerd.github.io/convertor](http://olifolkerd.github.io/convertor)

Convertor 
================================

An easy to use PHP unit conversion library.

Converter allows you to convert any unit to any other compatible unit type.

It has no external dependencies, simply include the library in your project and you're away!

Convertor can handle a wide range of unit types including:
<ul>
	<li>Length</li>
	<li>Area</li>
	<li>Volume</li>
	<li>Weight</li>
	<li>Speed</li>
	<li>Rotation</li>
	<li>Temperature</li>
	<li>Pressure</li>
	<li>Time</li>
	<li>Energy/Power</li>
</ul>

If you need aditional unit types, then it is easy to add your own.

Setup
================================
Setting up Convertor could not be simpler by using Composer.
Add the following to your `composer.json` file:
```
"repositories": [
	...
	{
		"type": "vcs",
		"url": "https://github.com/olifolkerd/convertor"
	}
	...
],
"require": {
	...
	"olifolkerd/convertor": "dev-master",
	...
}
```

Simple Example
================================

Once you have included the Converter.php library, creating conversions is as simple as creating an instance of the Convertor with the value to convert from, then specifying the new units

```php
$simpleConvertor = new Convertor(10, "m");
$simpleConvertor->to("ft"); //returns converted value
```
10 Meters = 32.808398950131 Feet

Define your own Units
================================
Convertor now supports using different files that contain the unit conversions by specifying either the path to the file containing the unit array or the filename of the file in `src/config`directly:
```php
//using the default file in `src/Config/Units.php`:
$c=new Convertor(100,"mps");
//using another file somewhere in the project:
$c=new Convertor(100,"mps",'/path/to/my/own/Units.php');
//using the name of the file in conf:
$c=new Convertor(100,"mps",'BaseUnits.php');
//define own units inline
$arr = [
    "m" => array("base" => "m", "conversion" => 1),
    "km" => array("base" => "m", "conversion" => 1000),
];

$c = new Convertor(1, 'm', $arr);
```

Currently two Unit files are available - one containing the owner's notation and the other one a more formal notation.
Differences in notation:

| Variant | km²     | kg/m²      | FileName        |
|---------|---------|------------|-----------------|
| owner   | 'km2'   | -          | `BaseUnits.php` |
| formal  | 'km**2' | 'kg m**-2' | `Units.php`     |

Additionally the `Units.php` file contains area-density definitions.


Resources
================================
- PHP-Skeleton as a template for the autoloading structure: [github](https://github.com/petk/php-skeleton)
