<?php
namespace Olifolkerd\Convertor\Tests;

use Olifolkerd\Convertor\Convertor;
use Olifolkerd\Convertor\Exceptions\ConvertorInvalidUnitException;
use PHPUnit\Framework\TestCase;

class ConvertorTest extends TestCase
{
    public function test_unit_does_not_exist()
    {
        $this->expectException(ConvertorInvalidUnitException::class);
        new Convertor(1, "nonsenseunit");
    }

    public function test_base_constructor()
    {
        $c = new Convertor();
        $c->from(6.16, 'ft');
        $this->assertEquals(1.87757, $c->to('m', 5));
    }

    public function conversionData(): array
    {
        return [
            /**
             * Format:
             * - float $value
             * - string $fromUnit
             * - string $toUnit
             * - float $expectedResult
             * - ?float $roundDecimals = null
             * - bool $doRound = true
             * - float $floatDelta = 0
             */

            /** Temperature */
            [0, 'c', 'f', 32, 2, true, 0],
            [0, 'c', 'k', 273.15, 2, true, 0],
            [0, 'c', 'c', 0, 2, true, 0],

            /** Weight */
            [100, 'g', 'g', 100, 6, true, 0],
            [100, 'g', 'kg', 0.1, 6, true, 0],
            [100, 'g', 'mg', 100000, 6, true, 0],
            [100, 'g', 'lb', 0.220462, 6, true, 1e-4],
            [100, 'g', 't', 1e-4, 6, true, 0],
            [100, 'g', 'oz', 3.527400, 6, true, 1e-4],
            [100, 'g', 'st', 0.0157473, 6, true, 1e-4],
            [100, 'g', 'N', 0.9806649999787735, 6, true, 1e-4],

            /** Pressure (@see http://convert-units.info/pressure/hectopascal/1) */
            [100, 'pa', 'pa', 100, 6, true, 1e-4],
            [100, 'pa', 'hpa', 1, 6, true, 1e-4],
            [100, 'pa', 'kpa', .1, 6, true, 1e-4],
            [100, 'pa', 'mpa', 0.0001, 6, true, 1e-4],
            [100, 'pa', 'bar', 0.001, 6, true, 1e-4],
            [100, 'pa', 'mbar', 1, 6, true, 1e-4],
            [100, 'pa', 'psi', 0.0145038, 6, true, 1e-4],

            /** Area Density */
            [1, 'kg m**-2', 'kg m**-2', 1, 6, true, 1e-4],
            [1, 'kg m**-2', 'kg km**-2', 1000000, 6, true, 1e-4],
            [1, 'kg m**-2', 'kg cm**-2', 1e-4, 6, true, 1e-4],
            [1, 'kg m**-2', 'kg mm**-2', 1e-6, 6, true, 1e-4],
            [1, 'kg m**-2', 'g m**-2', 1000, 6, true, 1e-4],
            [1, 'kg m**-2', 'mg m**-2', 1000000, 6, true, 1e-4],
            [1, 'kg m**-2', 'st m**-2', 0.157473, 6, true, 1e-4],
            [1, 'kg m**-2', 'lb m**-2', 2.20462, 6, true, 1e-4],
            [1, 'kg m**-2', 'oz m**-2', 35.274, 6, true, 1e-4],

            /** Speed */
            [3, 'km h**-1', 'm s**-1', 0.83333, 6, true, 1e-4],
            [3, 'km h**-1', 'km h**-1', 3, 6, true, 1e-4],
            [3, 'km h**-1', 'mi h**-1', 1.86411, 6, true, 1e-4],
            [100, 'm s**-1', 'm s**-1', 100, 3, true, 1e-4],
            [100, 'm s**-1', 'km h**-1', 360, 3, true, 1e-4],
            [100, 'm s**-1', 'mi h**-1', 223.694, 3, true, 1e-4],

            /** Distance */
            [5, 'km', 'm', 5e3, 6, true, 1e-4],
            [5, 'km', 'dm', 5e4, 6, true, 1e-4],
            [5, 'km', 'cm', 5e5, 6, true, 1e-4],
            [5, 'km', 'mm', 5e6, 6, true, 1e-4],
            [5, 'km', 'µm', 5e9, 6, true, 1e-4],
            [5, 'km', 'nm', 5e12, 6, true, 1e-4],
            [5, 'km', 'in', 196850.394, 6, true, 0.001],
            [5, 'km', 'ft', 16404.2, 6, true, 0.01],
            [5, 'km', 'yd', 5468.07, 6, true, 0.01],
            [5, 'km', 'mi', 3.10686, 6, true, 1e-4],
            [5, 'km', 'h', 196850.394/4, 6, true, 1e-4],
            [5, 'km', 'ly', 5.285e-13, 6, true, 1e-4],
            [5, 'km', 'au', 3.34229e-8, 6, true, 1e-4],
            [5, 'km', 'pc', 1.62038965e-13, 6, true, 1e-4],
            [3.086e+16, 'km', 'pc', 1000.1, 6, true, 0.01],
            [3.086e+16, 'km', 'au', 206286358.59320423007, 6, true, 1e-4],
            [3.086e+16, 'km', 'ly', 3261.9045737999631456, 6, true, 1e-4],

            /** Time */
            [100, 'hr', 's', 100*60*60, 6, true, 1e-4],
            [100, 'hr', 'min', 100*60, 6, true, 1e-4],
            [100, 'hr', 'hr', 100, 6, true, 1e-4],
            [100, 'hr', 'day', 100/24, 6, true, 1e-4],
            [100, 'hr', 'week', 100/24/7, 6, true, 1e-4],
            [100, 'hr', 'month', 100/24/7/31, 6, true, 1e-4],
            [100, 'hr', 'year', 100/24/365, 6, true, 1e-4],
            [100, 'hr', 'ms', 100*60*60*1000, 6, true, 1e-4],
            [100, 'hr', 'ns', 3600*1e+11, 6, true, 1e-4],
        ];
    }

    /** @dataProvider conversionData */
    public function test_unit_conversion(
        float $value,
        string $fromUnit,
        string $toUnit,
        float $expectedResult,
        ?float $roundDecimals = null,
        bool $doRound = true,
        float $floatDelta = 0
    ): void {
        $error     = sprintf('Failed to convert %01.2f %s to %s.', $value, $fromUnit, $toUnit);
        $convertor = new Convertor($value, $fromUnit);
        $result    = $convertor->to($toUnit, $roundDecimals, $doRound);
        $this->assertEquals($expectedResult, $result, $error, $floatDelta);
    }
}