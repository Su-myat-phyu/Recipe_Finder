<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class SpoonacularService
{
    public function searchRecipes(array $filters): array
    {
        $ingredients = $filters['ingredients'] ?? [];
        $cacheKey = 'spoonacular.search.'.md5(json_encode($filters));

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($filters, $ingredients): array {
            $payload = $this->client()
                ->get('/recipes/complexSearch', [
                    'includeIngredients' => implode(',', $ingredients),
                    'cuisine' => $filters['cuisine'] ?? null,
                    'diet' => $filters['diet'] ?? null,
                    'type' => $filters['meal_type'] ?? null,
                    'maxReadyTime' => $filters['max_ready_time'] ?? null,
                    'minCalories' => $filters['min_calories'] ?? null,
                    'maxCalories' => $filters['max_calories'] ?? null,
                    'addRecipeNutrition' => true,
                    'fillIngredients' => true,
                    'instructionsRequired' => true,
                    'number' => 12,
                    'sort' => $filters['sort'] ?? 'max-used-ingredients',
                ])
                ->throw()
                ->json();

            return collect($payload['results'] ?? [])
                ->map(fn (array $recipe): array => $this->normalizeSearchResult($recipe))
                ->all();
        });
    }

    public function recipeDetails(int $id): array
    {
        return Cache::remember("spoonacular.recipe.$id", now()->addHours(6), function () use ($id): array {
            $recipe = $this->client()
                ->get("/recipes/$id/information", [
                    'includeNutrition' => true,
                ])
                ->throw()
                ->json();

            return $this->normalizeRecipeDetails($recipe);
        });
    }

    protected function client(): PendingRequest
    {
        $apiKey = config('services.spoonacular.key');

        if (! $apiKey) {
            throw new RuntimeException('Spoonacular API key is not configured.');
        }

        return Http::baseUrl(config('services.spoonacular.base_url'))
            ->timeout((int) config('services.spoonacular.timeout', 12))
            ->acceptJson()
            ->withQueryParameters(['apiKey' => $apiKey]);
    }

    protected function normalizeSearchResult(array $recipe): array
    {
        $nutrition = collect($recipe['nutrition']['nutrients'] ?? []);

        return [
            'id' => $recipe['id'],
            'title' => $recipe['title'],
            'image' => $recipe['image'] ?? null,
            'ready_in_minutes' => $recipe['readyInMinutes'] ?? null,
            'servings' => $recipe['servings'] ?? null,
            'used_ingredients' => $recipe['usedIngredientCount'] ?? count($recipe['usedIngredients'] ?? []),
            'missed_ingredients' => $recipe['missedIngredientCount'] ?? count($recipe['missedIngredients'] ?? []),
            'calories' => $this->nutrientAmount($nutrition, 'Calories'),
            'protein' => $this->nutrientAmount($nutrition, 'Protein'),
            'fat' => $this->nutrientAmount($nutrition, 'Fat'),
            'carbs' => $this->nutrientAmount($nutrition, 'Carbohydrates'),
        ];
    }

    protected function normalizeRecipeDetails(array $recipe): array
    {
        $nutrition = collect($recipe['nutrition']['nutrients'] ?? []);
        $instructions = collect($recipe['analyzedInstructions'][0]['steps'] ?? [])
            ->map(fn (array $step): array => [
                'number' => $step['number'] ?? null,
                'step' => $step['step'] ?? '',
            ])
            ->all();

        return [
            'id' => $recipe['id'],
            'title' => $recipe['title'],
            'image' => $recipe['image'] ?? null,
            'ready_in_minutes' => $recipe['readyInMinutes'] ?? null,
            'servings' => $recipe['servings'] ?? null,
            'source_url' => $recipe['sourceUrl'] ?? null,
            'summary' => Str::of(strip_tags($recipe['summary'] ?? ''))->limit(360)->toString(),
            'dish_types' => $recipe['dishTypes'] ?? [],
            'diets' => $recipe['diets'] ?? [],
            'ingredients' => collect($recipe['extendedIngredients'] ?? [])
                ->map(fn (array $ingredient): string => $ingredient['original'] ?? $ingredient['name'] ?? '')
                ->filter()
                ->values()
                ->all(),
            'instructions' => $instructions,
            'nutrition' => [
                'calories' => $this->nutrientAmount($nutrition, 'Calories'),
                'protein' => $this->nutrientAmount($nutrition, 'Protein'),
                'fat' => $this->nutrientAmount($nutrition, 'Fat'),
                'carbs' => $this->nutrientAmount($nutrition, 'Carbohydrates'),
                'fiber' => $this->nutrientAmount($nutrition, 'Fiber'),
                'sugar' => $this->nutrientAmount($nutrition, 'Sugar'),
            ],
        ];
    }

    protected function nutrientAmount($nutrition, string $name): ?int
    {
        $nutrient = $nutrition->firstWhere('name', $name);

        return isset($nutrient['amount']) ? (int) round($nutrient['amount']) : null;
    }
}
