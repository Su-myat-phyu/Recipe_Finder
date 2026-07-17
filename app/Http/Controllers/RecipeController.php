<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeSearchRequest;
use App\Services\SearchHistoryService;
use App\Services\SpoonacularService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Auth;
use RuntimeException;

class RecipeController extends Controller
{
    public function __construct(
        protected SpoonacularService $spoonacular,
        protected SearchHistoryService $history,
    ) {
    }

    public function index()
    {
        return view('recipes.index', [
            'recipes' => [],
            'filters' => [],
            'searched' => false,
        ]);
    }

    public function search(RecipeSearchRequest $request)
    {
        $filters = array_merge($request->validated(), [
            'ingredients' => $request->ingredients(),
        ]);

        $isAjax = $request->boolean('ajax') || $request->expectsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest';

        try {
            $recipes = $this->spoonacular->searchRecipes($filters);
            $this->history->record(Auth::user(), $filters, count($recipes));
        } catch (RuntimeException | RequestException $exception) {
            report($exception);

            if ($isAjax) {
                return view('recipes.partials.results', [
                    'recipes' => [],
                    'filters' => $filters,
                    'searched' => true,
                    'error' => 'Recipe search is unavailable right now. Check your Spoonacular key or try again shortly.',
                ]);
            }

            return back()
                ->withInput()
                ->with('status', 'Recipe search is unavailable right now. Check your Spoonacular key or try again shortly.');
        }

        if ($isAjax) {
            return view('recipes.partials.results', [
                'recipes' => $recipes,
                'filters' => $filters,
                'searched' => true,
                'error' => null,
            ]);
        }

        return view('recipes.index', [
            'recipes' => $recipes,
            'filters' => $filters,
            'searched' => true,
        ]);
    }

    public function show(int $recipe)
    {
        try {
            $details = $this->spoonacular->recipeDetails($recipe);
        } catch (RuntimeException | RequestException $exception) {
            report($exception);

            return redirect()
                ->route('recipes.index')
                ->with('status', 'Recipe details are unavailable right now.');
        }

        $isFavorite = Auth::check()
            && Auth::user()->favoriteRecipes()->where('spoonacular_id', $recipe)->exists();

        return view('recipes.show', [
            'recipe' => $details,
            'isFavorite' => $isFavorite,
        ]);
    }
}
