<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileAttributesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProfileAttributes()
    {
        $response = $this->json('GET', '/api/v1/profile');
        $response->assertStatus(200)->assertJsonStructure([
            "name",
            "about_me",
            "email",
            "job_title"
        ]);
    }
}
