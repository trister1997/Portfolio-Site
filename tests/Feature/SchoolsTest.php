<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/v1/schools');
        $response->assertStatus(200)->assertJsonStructure([
            "*" => [
                "major",
                "name",
                "start_year",
                "end_year"
            ]
        ]);
    }
}
