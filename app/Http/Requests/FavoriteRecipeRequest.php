<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteRecipeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'spoonacular_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'ready_in_minutes' => ['nullable', 'integer', 'min:1', 'max:1440'],
            'servings' => ['nullable', 'integer', 'min:1', 'max:100'],
            'source_url' => ['nullable', 'url', 'max:500'],
            'summary' => ['nullable', 'string'],
            'meta' => ['nullable', 'array'],
        ];
    }
}
