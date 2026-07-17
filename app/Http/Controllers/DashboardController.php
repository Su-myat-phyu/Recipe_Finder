<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $favorites = $user->favoriteRecipes()->latest()->get();
        $histories = $user->searchHistories()->latest()->limit(8)->get();

        $favoriteMinutes = $favorites->avg('ready_in_minutes') ?: 0;
        $favoriteServings = $favorites->avg('servings') ?: 0;

        $recommendations = [];

        if ($favorites->isNotEmpty()) {
            $highlight = $favorites->first()->title;
            $recommendations = [
                [
                    'title' => 'Crispy herb bowls',
                    'tag' => 'Inspired by ' . $highlight,
                    'accent' => '🥗',
                ],
                [
                    'title' => 'Weeknight protein plates',
                    'tag' => 'Fast and filling',
                    'accent' => '🍋',
                ],
            ];
        } else {
            $recommendations = [
                [
                    'title' => 'Bright pasta night',
                    'tag' => 'A balanced starter',
                    'accent' => '🍝',
                ],
                [
                    'title' => 'Cozy soup reset',
                    'tag' => 'Comforting and simple',
                    'accent' => '🥣',
                ],
            ];
        }

        return view('dashboard.index', [
            'favorites' => $favorites,
            'histories' => $histories,
            'favoriteCount' => $favorites->count(),
            'historyCount' => $histories->count(),
            'favoriteMinutes' => (int) round($favoriteMinutes),
            'favoriteServings' => (int) round($favoriteServings),
            'recommendations' => $recommendations,
        ]);
    }
}
