<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConferencesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/v1/conferences');
        $response->assertStatus(200)->assertJsonStructure([
            "*" => [
                "name",
                "location",
                "link"
            ]
        ]);
    }
}
