<?php

namespace Juhara\Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Exception\ClientException;
use Juhara\Rajaongkir;

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
    public function itShouldReturnsProvinces()
    {

        $ro = new Rajaongkir($_ENV['API_KEY']);
        $resp = $ro->getProvinces();
        $this->assertObjectHasAttribute('rajaongkir', $resp);
        $this->assertEquals(200, $resp->rajaongkir->status->code);
    }

    /** @test */
    public function itShouldReturnsCities()
    {

        $ro = new Rajaongkir($_ENV['API_KEY']);
        $resp = $ro->getCities();
        $this->assertObjectHasAttribute('rajaongkir', $resp);
        $this->assertEquals(200, $resp->rajaongkir->status->code);
    }
}
