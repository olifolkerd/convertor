<?php
namespace Olifolkerd\Convertor;

use InvalidArgumentException;
use Olifolkerd\Convertor\Exceptions\ConvertorException;

final class ConversionDefinition
{
    /** @var string */
    private $unit;

    /** @var string */
    private $baseUnit;

    /** @var float|Callable */
    private $conversion;

    /**
     * @param string $unit
     * @param string $baseUnit
     * @param float|Callable $conversion
     */
    public function __construct(string $unit, string $baseUnit, $conversion)
    {
        $this->unit = $unit;
        $this->baseUnit = $baseUnit;
        $this->conversion = $conversion;

        if (! is_numeric($conversion) && ! is_callable($conversion)) {
            throw new ConvertorException('A conversion must be either numeric or a callable.');
        }
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getBaseUnit(): string
    {
        return $this->baseUnit;
    }

    public function isBaseUnit(): bool
    {
        return $this->unit === $this->baseUnit;
    }

    public function convertToBase(float $value): float
    {
        if (is_numeric($this->conversion)) {
            return $value * $this->conversion;
        } elseif (is_callable($this->conversion)) {
            $converter = $this->conversion;
            return $converter($value, false);
        }
        throw new ConvertorException('The conversion must be either numeric or callable.');
    }

    public function convertFromBase(float $value): float
    {
        if (is_numeric($this->conversion)) {
            return $value / $this->conversion;
        } elseif (is_callable($this->conversion)) {
            $converter = $this->conversion;
            return $converter($value, true);
        }
        throw new ConvertorException('The conversion must be either numeric or callable.');
    }
}