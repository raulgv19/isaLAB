<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanBeCreated()
    {
        $userData = [
            'name' => 'fiwiliwem',
            'email' => 'fiwiliwem@mailinator.com',
            'password' => 'Pa$$w0rd!',
        ];

        $response = $this->post('/users', $userData);

        $response->assertOK();
        //$response->assertRedirect('/users');
    }
}
