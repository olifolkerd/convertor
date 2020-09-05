<?php

/*
 * This file is part of the LegacyConvertor package.
 *
 * (c) Oliver Folkerd <oliver.folkerd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Olifolkerd\Convertor;

use Olifolkerd\Convertor\Exceptions\ConvertorDifferentTypeException;
use Olifolkerd\Convertor\Exceptions\ConvertorException;
use Olifolkerd\Convertor\Exceptions\ConvertorInvalidUnitException;
use Olifolkerd\Convertor\Exceptions\FileNotFoundException;

class Convertor
{
    /** @var ?float */
    private $value;

    /** @var ?string */
    private $baseUnit;

    /** @var ConversionRepository */
    private $units;

    public function __construct(?float $value = null, ?string $unit = null, ?string $unitFile = null)
    {
        $this->loadUnits($unitFile);

        if (! is_null($value)) {
            $this->from($value, $unit);
        }
    }

    /**
     * Allow switching between different unit definition files. Defaults to src/Config/Units.php
     * @param ?string $path Load your own units file if you want.
     * @throws FileNotFoundException
     */
    private function loadUnits(?string $path = null): void
    {
        if (! $path) {
            $path =  __DIR__ . '/Config/Units.php';
        }

        $this->units = ConversionRepository::fromFile($path);
    }

    /**
     * Set from conversion value / unit
     *
     * @param  float  $value -  a numeric value to base conversions on
     * @param  string $unit (optional) - the unit symbol for the start value
     * @return Convertor
     * @throws ConvertorException - general errors
     * @throws ConvertorInvalidUnitException - specific invalid unit exception
     */
    public function from(float $value, ?string $unit = null): Convertor
    {
        if (! $unit) {
            $this->value = $value;
            return $this;
        }

        if (! $this->units->unitExists($unit)) {
            throw new ConvertorInvalidUnitException("Conversion from Unit u=$unit not possible - unit does not exist.");
        }

        $conversion     = $this->units->getConversion($unit);
        $this->baseUnit = $conversion->getBaseUnit();
        $this->value    = $conversion->convertToBase($value);


        return $this;
    }

    /**
     * Convert from value to new unit
     *
     * @param    string  $unit -  the unit symbol (or array of symbols) for the conversion unit
     * @param    ?int    $decimals (optional, default-null) - the decimal precision of the conversion result
     * @param    boolean $round (optional, default-true) - round or floor the conversion result
     * @return   float|array
     */
    public function to(string $unit, ?int $decimals = null, bool $round = true)
    {
        if (is_null($this->value)) {
            throw new ConvertorException("From Value Not Set.");
        }

        if (is_array($unit)) {
            return $this->toMany($unit, $decimals, $round);
        }

        if (! $this->units->unitExists($unit)) {
            throw new ConvertorInvalidUnitException("Conversion from Unit u=$unit not possible - unit does not exist.");
        }

        $conversion = $this->units->getConversion($unit);

        if (! $this->baseUnit) {
            $this->baseUnit = $conversion->getBaseUnit();
        }

        if ($conversion->getBaseUnit() !== $this->baseUnit) {
            throw new ConvertorDifferentTypeException("Cannot Convert Between Units of Different Types");
        }

        $result = $conversion->convertFromBase($this->value);

        if (! is_null($decimals)) {
            return $this->round($result, $decimals, $round);
        }

        return $result;
    }

    /**
     * @param string[] $units
     * @param ?int     $decimals
     * @param bool     $round
     * @return array
     */
    private function toMany($units = [], ?int $decimals = null, $round = true)
    {
        return array_map(function ($unit) use ($decimals, $round) {
            return $this->to($unit, $decimals, $round);
        }, $units);
    }

    /**
     * Convert from value to all compatible units.
     * @param int|null $decimals
     * @param bool     $round
     * @return array
     * @throws ConvertorException
     */
    public function toAll(?int $decimals = null, bool $round = true)
    {
        if (is_null($this->value)) {
            throw new ConvertorException("From Value Not Set");
        }

        if (is_null($this->baseUnit)) {
            throw new ConvertorException("No From Unit Set");
        }

        return $this->toMany($this->getUnits($this->baseUnit), $decimals, $round);
    }

    /**
     * @param string         $unit
     * @param string         $base
     * @param float|Callable $conversion
     * @return bool
     */
    public function addUnit(string $unit, string $base, $conversion)
    {
        $conversion = new ConversionDefinition($unit, $base, $conversion);
        $this->units->addConversion($conversion);
        return true;
    }

    /**
     * @param string $unit
     * @return bool
     */
    public function removeUnit(string $unit): bool
    {
        $this->units->removeConversion($unit);
        return true;
    }

    /**
     * List all available conversion units for given unit.
     * @param string $unit
     * @return string[]
     */
    public function getUnits(string $unit): array
    {
        return $this->units->getAvailableConversions($unit);
    }

    private function round(float $value, int $decimals, bool $round): float
    {
        $mode = $round ? PHP_ROUND_HALF_UP : PHP_ROUND_HALF_DOWN;
        return round($value, $decimals, $mode);
    }
}
