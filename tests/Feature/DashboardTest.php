<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_renders_personalized_sections(): void
    {
        $user = User::factory()->create([
            'name' => 'Ava',
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Welcome back');
        $response->assertSee('Favorite recipes');
        $response->assertSee('Recently searched');
        $response->assertSee('Recommended recipes');
        $response->assertSee('Recipe statistics');
        $response->assertSee('Quick actions');
    }
}
