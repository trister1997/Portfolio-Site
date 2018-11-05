<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/v1/projects');
        $response->assertStatus(200)->assertJsonStructure([
            "*" => [
                "title",
                "description",
                "link",
                "image"
            ]
        ]);
    }
}
