<?php

namespace App\Nova\Repeater;

use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class OddOneOutGames extends Repeatable
{
    /**
     * Get the fields displayed by the repeatable.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Textarea::make('Question')->help("One option per line"),
            Text::make('Solution'),
            Text::make('Hint')->help("Optional"),
        ];
    }
}
