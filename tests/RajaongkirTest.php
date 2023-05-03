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
        $this->expectException(ClientException::class);

        $ro = new Rajaongkir($_ENV['API_KEY']);
        $resp = $ro->getProvinces();
    }
}
