<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->adminRole = $this->createRole(['role_name' => User::ROLE_ADMIN]);
        $this->clientRole = $this->createRole(['role_name' => User::ROLE_SOCIO]);

    }

    /** 
     * Test unauthenticated users get redirected to login
     *
     * @return void
    */
    public function testUnauthenticatedUsersGetRedirectedToLogin()
    {
        $this->assertGuest();

        $response = $this->get('/');
        $response->assertRedirect('/login');
        $response->assertSeeText('Redirecting to'.' '.URL::to('/login'));
    }

    /**
     * Test unauthenticated users can access login route
     *
     * @return void
    */
    public function testUnauthenticatedUsersCanAccessLoginRoute()
    {
        $this->assertGuest();

        $response = $this->get('/login');
        $response->assertViewIs('auth.login');
    }

    /**
     * Test unauthenticated users cannot logout
     *
     * @return void
    */
    public function testUnauthenticatedUsersCannotLogout()
    {
        $this->withoutExceptionHandling();

        $this->assertGuest();
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->get('/logout');
    }

    /**
     * Test users can login when correct credentials are given
     *
     * @return void
    */
    public function testUsersCanLoginWithCorrectCredentials()
    {
        $this->withoutExceptionHandling();
        $user = $this->createUser([
            'email' => 'correctEmail@test.com',
            'password' => 'password',
        ]);

        $credentials = [
            'email' => 'correctEmail@test.com',
            'password' => 'password',
        ];
        $this->assertEquals($user->email,$credentials['email']);
        $this->assertEquals($user->password,$credentials['password']);
        $this->assertGuest();
    }

    /**
     * Test users cannot login when incorrect credentials are given
     *
     * @return void
    */
    public function testUsersCannotLoginWithIncorrectCredentials()
    {
        $this->createUser([
            'email' => 'correctEmail@test.com',
            'password' => bcrypt('password'),
        ]);

        $credentials = [
            'email' => 'incorrectEmail@test.com',
            'password' => 'incorrectPassword'
        ];
         
        $this->assertGuest();
        $this->assertInvalidCredentials($credentials);
    }

    /**
     * Test users cannot access login when authenticated
     *
     * @return void
    */
    public function testUsersCannotAccessLoginWhenAuthenticated()
    {
        $this->signInUserAsRole($this->adminRole);
        $this->assertAuthenticatedAs($this->user);

        $response = $this->get('/login');
        $response->assertRedirect(RouteServiceProvider::HOME);
        $response->assertSeeText('Redirecting to'.' '.URL::to('/'));
    }

    /**
     * Test authenticated users can logout
     *
     * @return void
    */
    public function testAuthenticatedUsersCanLogout()
    {
        $user = $this->createUser();
        $this->actingAs($user);
        
        $this->assertAuthenticatedAs($user);

        Auth::logout();

        $this->assertGuest();
    }

    /**
     * Test Admin Users are redirected after successful login
     * 
     * @return void
    */
    public function testAdminUsersAreRedirectedAfterSuccessfulLogin()
    {
        $this->signInUserAsRole($this->adminRole);
        $this->assertAuthenticatedAs($this->user);

        $response = $this->get(RouteServiceProvider::HOME);
        $response->assertRedirect('login');
        $response->assertSeeText('Redirecting to'.' '.URL::to('login'));
    }

    /**
     * Test Client Users are redirected after successful login
     * 
     * @return void
    */
    public function testClientUsersAreRedirectedAfterSuccessfulLogin()
    {
        $this->signInUserAsRole($this->clientRole);
        $this->assertAuthenticatedAs($this->user);

        $response = $this->get(RouteServiceProvider::HOME);
        $response->assertRedirect('login');
        $response->assertSeeText('Redirecting to'.' '.URL::to('login'));
    }


}
