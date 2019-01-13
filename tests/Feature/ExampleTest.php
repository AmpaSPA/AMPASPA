<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * ExampleTest: clase para las pruebas de peticiones html
 * @group Ejemplo
 */
class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
