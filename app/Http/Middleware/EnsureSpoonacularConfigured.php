<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSpoonacularConfigured
{
    public function handle(Request $request, Closure $next)
    {
        if (! config('services.spoonacular.key')) {
            return redirect()
                ->route('recipes.index')
                ->with('status', 'Add SPOONACULAR_API_KEY to your .env file before searching recipes.');
        }

        return $next($request);
    }
}
