<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testDashboard()
    {
        $user = User::whereHas('roles', function(Builder $query){
            $query->where('name', 'shop-admin');
        })->first();
        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertStatus(200);
    }

}
