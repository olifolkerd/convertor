<?php

use Olifolkerd\Convertor\Convertor;
use Olifolkerd\Convertor\Exceptions\ConvertorInvalidUnitException;
use PHPUnit\Framework\TestCase;

//todo: add tests for all other conversions.

/**
 * Class Test
 * Provides tests for the convertor to make sure conversions are fine
 * Currently tested unit groups are:
 * - Temperature
 * - Weight
 * - Pressure
 * - Area density
 * - Speeds
 * - Distance
 * - time
 * todo:
 * - area
 * - volume
 * - power
 */
class Test extends TestCase
{

    /** @test */
    public function testTemperature()
    {
        $conv = new Convertor();
        $conv->from(0,'c');
        $val=$conv->toAll(2);

        $this->assertEquals(32,$val['f'] );
        $this->assertEquals(273.15,$val['k']);
        $this->assertEquals(0,$val['c'] );
    }

    /** @test */
    public function testWeight()
    {
        $conv = new Convertor();
        $conv->from(100,'g');
        $val=$conv->toAll(6,true);
        $this->assertEquals(100,$val['g'] );
        $this->assertEquals(.1,$val['kg'] );
        $this->assertEquals(100000,$val['mg'] );
        $this->assertEquals(0.220462,$val['lb'],"Not inside of float delta",0.00001);
        $this->assertEquals(1e-4,$val['t']);
        $this->assertEquals(3.527400,$val['oz'],"Not inside of float delta",0.00001);
        $this->assertEquals(0.0157473,$val['st'],"Not inside of float delta",0.00001);
        $this->assertEquals(0.0157473,$val['st'],"Not inside of float delta",0.00001);
        $this->assertEquals(0.9806649999787735,$val['N'],"Not inside of float delta",0.00001);
    }

    /** @test */
    public function testPressure()
    {
        $conv = new Convertor();
        $conv->from(100,'pa');
        $val=$conv->toAll(6,true);
        // http://convert-units.info/pressure/hectopascal/1
        $this->assertEquals(100,$val['pa'],"Not inside of float delta",0.00001);
        $this->assertEquals(1,$val['hpa'],"Not inside of float delta",0.00001);
        $this->assertEquals(.1,$val['kpa'],"Not inside of float delta",0.00001);
        $this->assertEquals(0.0001,$val['mpa'],"Not inside of float delta",0.00001);
        $this->assertEquals(0.001,$val['bar'],"Not inside of float delta",0.00001);
        $this->assertEquals(1,$val['mbar'],"Not inside of float delta",0.00001);
        $this->assertEquals(0.0145038,$val['psi'],"Not inside of float delta",0.00001);
    }

    /** @test */
    public function testAreaDensity()
    {
        $conv = new Convertor();
        $conv->from(1,'kg m**-2');
        $val=$conv->toAll(6,true);
        $this->assertEquals(1,$val['kg m**-2'],"Not inside of float delta",0.00001);
        $this->assertEquals(1000000,$val['kg km**-2'],"Not inside of float delta",0.00001);
        $this->assertEquals(1e-4,$val['kg cm**-2'],"Not inside of float delta",0.00001);
        $this->assertEquals(1e-6,$val['kg mm**-2'],"Not inside of float delta",0.00001);
        $this->assertEquals(1000,$val['g m**-2'],"Not inside of float delta",0.00001);
        $this->assertEquals(1000000,$val['mg m**-2'],"Not inside of float delta",0.00001);
        $this->assertEquals(0.157473,$val['st m**-2'],"Not inside of float delta",0.00001);
        $this->assertEquals(2.20462,$val['lb m**-2'],"Not inside of float delta",0.00001);
        $this->assertEquals(35.274,$val['oz m**-2'],"Not inside of float delta",0.00001);
    }
    /** @test */
    public function testSpeeds()
    {
        $conv = new Convertor();
        $conv->from(3,'km h**-1');
        $val=$conv->toAll(6,true);
        $this->assertEquals(0.83333,$val['m s**-1'],"Not inside of float delta",0.00001);
        $this->assertEquals(3,$val['km h**-1'],"Not inside of float delta",0.00001);
        $this->assertEquals(1.86411,$val['mi h**-1'],"Not inside of float delta",0.00001);
        $conv->from(100,'m s**-1');
        $val=$conv->toAll(3,true);
        $this->assertEquals(100,$val['m s**-1'],"Not inside of float delta",0.00001);
        $this->assertEquals(360,$val['km h**-1'],"Not inside of float delta",0.00001);
        $this->assertEquals(223.694,$val['mi h**-1'],"Not inside of float delta",0.0001);
    }

    /** @test */
    public function testDistance()
    {
        $conv = new Convertor();
        $conv->from(5,'km');
        $val=$conv->toAll(6,true);
        $delta=1e-4;
        $this->assertEquals(5e3,$val['m'],"Not inside of float delta",$delta);
        $this->assertEquals(5e4,$val['dm'],"Not inside of float delta",$delta);
        $this->assertEquals(5e5,$val['cm'],"Not inside of float delta",$delta);
        $this->assertEquals(5e6,$val['mm'],"Not inside of float delta",$delta);
        $this->assertEquals(5e9,$val['µm'],"Not inside of float delta",$delta);
        $this->assertEquals(5e12,$val['nm'],"Not inside of float delta",$delta);
        $this->assertEquals(5e15,$val['pm'],"Not inside of float delta",$delta);
        $this->assertEquals(196850.394,$val['in'],"Not inside of float delta",0.001);
        $this->assertEquals(16404.2,$val['ft'],"Not inside of float delta",0.01);
        $this->assertEquals(5468.07,$val['yd'],"Not inside of float delta",0.01);
        $this->assertEquals(3.10686,$val['mi'],"Not inside of float delta",$delta);
        // 1h=4inch
        $this->assertEquals(196850.394/4,$val['h'],"Not inside of float delta",$delta);
        $this->assertEquals(5.285e-13,$val['ly'],"Not inside of float delta",$delta);
        $this->assertEquals(3.34229e-8,$val['au'],"Not inside of float delta",$delta);
        $this->assertEquals(1.62038965e-13,$val['pc'],"Not inside of float delta",$delta);

        //test big units
        $conv->from(3.086e+16,'km');
        $this->assertEquals(1000.1,$conv->to('pc'),"Not inside of float delta",0.01);
        $this->assertEquals(206286358.59320423007,$conv->to('au'),"Not inside of float delta",$delta);
        $this->assertEquals(3261.9045737999631456,$conv->to('ly'),"Not inside of float delta",$delta);
    }

    /** @test */
    public function testTime(){
        $conv = new Convertor();
        $conv->from(100,'hr');
        $val=$conv->toAll(6,true);
        $delta=1e-4;
        $this->assertEquals(100*60*60,$val['s'],"Not inside of float delta",$delta);
        $this->assertEquals(100*60,$val['min'],"Not inside of float delta",$delta);
        $this->assertEquals(100,$val['hr'],"Not inside of float delta",$delta);
        $this->assertEquals(100/24,$val['day'],"Not inside of float delta",$delta);
        $this->assertEquals(100/24/7,$val['week'],"Not inside of float delta",$delta);
        $this->assertEquals(100/24/7/31,$val['month'],"Not inside of float delta",$delta);
        $this->assertEquals(100/24/365,$val['year'],"Not inside of float delta",$delta);
        $this->assertEquals(100*60*60*1000,$val['ms'],"Not inside of float delta",$delta);
        $this->assertEquals(3600*1e+11,$val['ns'],"Not inside of float delta",$delta);
    }
    /** @test */
    public function testUnitDoesNotExist()
    {
        $this->expectException(ConvertorInvalidUnitException::class);
        new Convertor(1, "nonsenseunit");
    }

    /** @test */
    public function testBaseConstructor()
    {
        $c = new Convertor();
        $c->from(6.16, 'ft');
        $this->assertEquals(1.87757, $c->to('m', 5));
    }
}