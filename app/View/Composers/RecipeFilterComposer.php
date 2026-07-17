<?php

namespace App\View\Composers;

use Illuminate\View\View;

class RecipeFilterComposer
{
    public function compose(View $view): void
    {
        $view->with([
            'cuisines' => [
                'African',
                'American',
                'Asian',
                'British',
                'Cajun',
                'Caribbean',
                'Chinese',
                'French',
                'Greek',
                'Indian',
                'Italian',
                'Japanese',
                'Korean',
                'Mediterranean',
                'Mexican',
                'Middle Eastern',
                'Spanish',
                'Thai',
                'Vietnamese',
            ],
            'diets' => [
                'Gluten Free',
                'Ketogenic',
                'Vegetarian',
                'Lacto-Vegetarian',
                'Ovo-Vegetarian',
                'Vegan',
                'Pescetarian',
                'Paleo',
                'Primal',
                'Low FODMAP',
                'Whole30',
            ],
            'prepTimes' => [
                15 => '15 min',
                30 => '30 min',
                45 => '45 min',
                60 => '1 hour',
                90 => '90 min',
            ],
        ]);
    }
}
