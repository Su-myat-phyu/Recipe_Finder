<?php

namespace App\Services;

use App\Models\SearchHistory;
use App\Models\User;

class SearchHistoryService
{
    public function record(?User $user, array $filters, int $resultsCount): void
    {
        SearchHistory::create([
            'user_id' => $user?->id,
            'ingredients' => $filters['ingredients'],
            'cuisine' => $filters['cuisine'] ?? null,
            'diet' => $filters['diet'] ?? null,
            'max_ready_time' => $filters['max_ready_time'] ?? null,
            'results_count' => $resultsCount,
        ]);
    }
}
