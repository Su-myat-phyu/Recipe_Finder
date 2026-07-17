<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteRecipeRequest;
use App\Services\FavoriteRecipeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteRecipeController extends Controller
{
    public function __construct(protected FavoriteRecipeService $favorites)
    {
    }

    public function index()
    {
        $favorites = Auth::user()->favoriteRecipes()->latest()->get();

        return view('favorites.index', [
            'favorites' => $favorites,
        ]);
    }

    public function store(FavoriteRecipeRequest $request): RedirectResponse|JsonResponse
    {
        $this->favorites->save(Auth::user(), $request->validated());

        if ($request->expectsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'favorited' => true,
                'message' => 'Recipe saved to your favorites.',
            ]);
        }

        return back()->with('status', 'Recipe saved to your favorites.');
    }

    public function destroy(int $recipe)
    {
        $this->favorites->remove(Auth::user(), $recipe);

        if (request()->expectsJson() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'favorited' => false,
                'message' => 'Recipe removed from your favorites.',
            ]);
        }

        return back()->with('status', 'Recipe removed from your favorites.');
    }
}
