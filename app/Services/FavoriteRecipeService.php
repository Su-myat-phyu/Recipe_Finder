<?php

namespace App\Services;

use App\Models\FavoriteRecipe;
use App\Models\User;

class FavoriteRecipeService
{
    public function save(User $user, array $data): FavoriteRecipe
    {
        return FavoriteRecipe::updateOrCreate(
            [
                'user_id' => $user->id,
                'spoonacular_id' => $data['spoonacular_id'],
            ],
            $data
        );
    }

    public function remove(User $user, int $recipeId): void
    {
        $user->favoriteRecipes()
            ->where('spoonacular_id', $recipeId)
            ->delete();
    }
}
