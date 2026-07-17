<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavoriteRecipe extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'spoonacular_id',
        'title',
        'image_url',
        'ready_in_minutes',
        'servings',
        'source_url',
        'summary',
        'meta',
    ];

    protected function casts(): array
    {
        return [
            'meta' => 'array',
            'ready_in_minutes' => 'integer',
            'servings' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
