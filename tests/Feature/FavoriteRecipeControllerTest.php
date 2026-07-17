<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteRecipeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_save_and_remove_favorites_with_json_requests(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->withHeader('X-Requested-With', 'XMLHttpRequest')
            ->postJson('/favorites', [
                'spoonacular_id' => 12345,
                'title' => 'Tasty Bowl',
                'image_url' => 'https://example.com/image.jpg',
                'ready_in_minutes' => 20,
                'servings' => 2,
                'source_url' => 'https://example.com/recipe',
                'summary' => 'Lovely recipe',
                'meta' => ['tag' => 'test'],
            ]);

        $response->assertOk()
            ->assertJsonPath('favorited', true)
            ->assertJsonPath('message', 'Recipe saved to your favorites.');

        $this->assertDatabaseHas('favorite_recipes', [
            'user_id' => $user->id,
            'spoonacular_id' => 12345,
        ]);

        $response = $this->withHeader('X-Requested-With', 'XMLHttpRequest')
            ->deleteJson('/favorites/12345');

        $response->assertOk()
            ->assertJsonPath('favorited', false)
            ->assertJsonPath('message', 'Recipe removed from your favorites.');

        $this->assertDatabaseMissing('favorite_recipes', [
            'user_id' => $user->id,
            'spoonacular_id' => 12345,
        ]);
    }
}
