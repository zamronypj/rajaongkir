<?php

namespace Juhara\Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Exception\ClientException;
use Juhara\Rajaongkir;
use InvalidArgumentException;

final class RajaongkirTest extends TestCase
{
    /** @test */
    public function itShouldThrowExceptionIfApiKeyNotSet()
    {
        $this->expectException(ClientException::class);

        $ro = new Rajaongkir();
        $resp = $ro->getProvinces();
    }

    /** @test */
    public function itShouldThrowExceptionIfApiKeyNotValid()
    {
        $this->expectException(ClientException::class);

        $ro = new Rajaongkir('xxxxxx');
        $resp = $ro->getProvinces();
    }

    /** @test */
    public function itShouldThrowExceptionIfAccountTypeNotValid()
    {
        $this->expectException(InvalidArgumentException::class);

        $ro = new Rajaongkir($_ENV['API_KEY'], 'xxxx');
        $resp = $ro->getProvinces();
    }

    /** @test */
    public function itShouldReturnsProvinces()
    {

        $ro = new Rajaongkir($_ENV['API_KEY']);
        $resp = $ro->getProvinces();
        $this->assertTrue(property_exists($resp, 'rajaongkir'));
        $this->assertEquals(200, $resp->rajaongkir->status->code);
    }

    /** @test */
    public function itShouldReturnsCities()
    {

        $ro = new Rajaongkir($_ENV['API_KEY']);
        $resp = $ro->getCities();
        $this->assertTrue(property_exists($resp, 'rajaongkir'));
        $this->assertEquals(200, $resp->rajaongkir->status->code);
    }

    /** @test */
    public function itShouldReturnsCosts()
    {

        $ro = new Rajaongkir($_ENV['API_KEY']);
        $resp = $ro->getCost(['city'=>1 ], ['city' => 2], ['weight' => 400], 'jne');
        $this->assertTrue(property_exists($resp, 'rajaongkir'));
        $this->assertEquals(200, $resp->rajaongkir->status->code);
    }

    /** @test */
    public function itShouldReturnsCouriers()
    {
        $ro = new Rajaongkir($_ENV['API_KEY']);
        $resp = $ro->getCouriersList();
        $this->assertArrayHasKey('jne', $resp);
    }
}
