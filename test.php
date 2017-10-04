<?php
/**
 * User: Fabian Widmann
 * Date: 04.10.17
 * Time: 12:39
 */

require 'vendor/autoload.php';

use Olifolkerd\Convertor\Convertor;

$c = new Convertor(1,"km");
print_r($c->to(["m"]));