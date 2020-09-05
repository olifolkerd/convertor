<?php
namespace Olifolkerd\Convertor\Tests;

use Olifolkerd\Convertor\ConversionRepository;
use PHPUnit\Framework\TestCase;

class ConversionRepositoryTest extends TestCase
{
    public function test_km_to_base_conversion(): void
    {
        $repository = ConversionRepository::fromFile(__DIR__.'/../src/Config/Units.php');

        $this->assertInstanceOf(ConversionRepository::class, $repository);

        $kilometers = 8.5;
        $meters = $repository->getConversion('km')->convertToBase($kilometers);
        $this->assertEquals(8500, $meters);
    }
}