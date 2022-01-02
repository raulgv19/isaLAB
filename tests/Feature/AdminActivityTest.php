<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class AdminActivityTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->adminRole = $this->createRole(['role_name' => User::ROLE_ADMIN]);
        $this->clientRole = $this->createRole(['role_name' => User::ROLE_SOCIO]);

    }

    /**
     * Test unauthenticated users cannot access view
     *
     * @return void
    */
    public function testUnauthenticatedUsersCannotAccessView()
    {
        $this->assertGuest();

        $response = $this->get('/admin/activities');
        $response->assertRedirect('/login');
        $response->assertSeeText('Redirecting to'.' '.URL::to('/login'));
    }

    /**
     * Test client users cannot access view
     *
     * @return void
    */
    public function testClientUsersCannotAccessView()
    {
        $this->signInUserAsRole($this->clientRole);
        $this->assertAuthenticatedAs($this->user);

        $response = $this->get('/admin/activities');
        $response->assertRedirect('/');
        $response->assertSeeText('Redirecting to'.' '.URL::to('/'));
    }

    /**
     * Test admin users can access view
     *
     * @return void
    */
    public function testAdminUsersCannotAccessView()
    {
        $this->signInUserAsRole($this->adminRole);
        $this->assertAuthenticatedAs($this->user);

        $response = $this->get('/admin/activities');
        $response->assertViewIs('admin.activities.index');
    }

    /**
     * Test Admin User can access create activity
     *
     * @return void
    */
    public function testAdminUsersCanAccessCreateActivity()
    {
        $this->signInUserAsRole($this->adminRole);
        $this->assertAuthenticatedAs($this->user);

        $response = $this->get('admin/activities/create');
        $response->assertViewIs('admin.activities.create');
    }

    /**
     * Test Admin User can create activity
     *
     * @return void
    */
    public function testAdminUsersCanCreateActivity()
    {
        $this->signInUserAsRole($this->adminRole);
        $this->assertAuthenticatedAs($this->user);

        $activityData = ([
            'name' => 'Zumba',
            'capacity' => 21,
            'duration' => 45,
            'schedule' => '2022-01-01 22:29:02',
            'instructor_name' => 'Robert Gomez'
        ]);
        $response = $this->json('POST', 'admin/activities', $activityData);

        $newActivity = Activity::all()->last()->fresh();

        $this->assertEquals($newActivity->name, $activityData['name']);
        $this->assertEquals($newActivity->capacity, $activityData['capacity']);
        $this->assertEquals($newActivity->duration, $activityData['duration']);
        $this->assertEquals($newActivity->schedule, $activityData['schedule']);
        $this->assertEquals($newActivity->instructor_name, $activityData['instructor_name']);

        $response->assertRedirect('admin/activities');
        $response->assertSeeText('Redirecting to'.' '.URL::to('admin/activities'));
    }

    /**
     * Test Admin User can access edit activity
     *
     * @return void
    */
    public function testAdminUsersCanAccessEditActivity()
    {
        $this->signInUserAsRole($this->adminRole);
        $this->assertAuthenticatedAs($this->user);

        $activity = $this->createActivity();

        $response = $this->get('admin/activities/'.$activity->id.'/edit');
        $response->assertViewIs('admin.activities.edit');
    }

    /**
     * Test Admin User can update activity
     *
     * @return void
    */
    public function testAdminUsersCanUpdateUser()
    {
        $this->signInUserAsRole($this->adminRole);
        $this->assertAuthenticatedAs($this->user);

        $activity = $this->createActivity();

        $activityData = ([
            'name' => 'Zumba',
            'capacity' => 21,
            'duration' => 45,
            'schedule' => '2022-01-01 22:29:02',
            'instructor_name' => 'Robert Gomez'
        ]);

        $activity->update($activityData);
        $activity = $activity->fresh();

        $this->assertEquals($activity->name, $activityData['name']);
        $this->assertEquals($activity->capacity, $activityData['capacity']);
        $this->assertEquals($activity->duration, $activityData['duration']);
        $this->assertEquals($activity->schedule, $activityData['schedule']);
        $this->assertEquals($activity->instructor_name, $activityData['instructor_name']);
    }

    /**
     * Test Operator Admin Users can delete clinic user
     * 
     * 
     * @return void
    */
    public function testOperatorAdminUsersCanDeleteClinicUser()
    {
        $this->withoutExceptionHandling();

        $this->signInUserAsRole($this->adminRole);
        $this->assertAuthenticatedAs($this->user);
        
        $activity = $this->createActivity();
        
        $response = $this->json('DELETE', 'admin/activities/'.$activity->id);

        $response->assertRedirect('admin/activities');
        $response->assertSeeText('Redirecting to'.' '.URL::to('admin/activities'));
    
    }


}
