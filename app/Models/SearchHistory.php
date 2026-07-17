<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SearchHistory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'ingredients',
        'cuisine',
        'diet',
        'max_ready_time',
        'results_count',
    ];

    protected function casts(): array
    {
        return [
            'ingredients' => 'array',
            'max_ready_time' => 'integer',
            'results_count' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
