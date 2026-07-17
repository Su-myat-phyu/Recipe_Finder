<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeSearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ingredients' => ['nullable', 'string', 'max:500'],
            'cuisine' => ['nullable', 'string', 'max:60'],
            'diet' => ['nullable', 'string', 'max:60'],
            'meal_type' => ['nullable', 'string', 'max:60'],
            'max_ready_time' => ['nullable', 'integer', 'min:5', 'max:240'],
            'min_calories' => ['nullable', 'integer', 'min:0', 'max:5000'],
            'max_calories' => ['nullable', 'integer', 'min:0', 'max:5000'],
            'sort' => ['nullable', 'in:max-used-ingredients,time,calories,random'],
            'ajax' => ['nullable', 'boolean'],
        ];
    }

    public function ingredients(): array
    {
        return collect(preg_split('/[\n,]+/', (string) ($this->validated('ingredients') ?? '')))
            ->map(fn (string $ingredient): string => trim($ingredient))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }
}
