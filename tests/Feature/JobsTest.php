<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/v1/jobs');
        $response->assertStatus(200)->assertJsonStructure([
            "*" => [
                "title",
                "company",
                "start_year",
                "end_year",
                "description"
            ]
        ]);
    }
}
