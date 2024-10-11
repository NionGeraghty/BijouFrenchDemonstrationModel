<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;

class Activity extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Activity>
     */
    public static $model = \App\Models\Activity::class;



    public static $perPageViaRelationship = 20;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Title')->sortable(),
            Text::make('Order Column')->sortable()->default(function ($request){
                return \App\Models\Activity::max('order_column') + 1;
            })->hideFromIndex()->hideWhenUpdating(),
            File::make('Worksheet')->disk('public')->hideFromDetail()->path("files")->storeOriginalName('worksheet_name'),
            Text::make("Worksheet Name")->hideWhenUpdating()->hideWhenCreating()->readonly(),
            File::make('Answers')->disk('public')->hideFromDetail()->path("files")->storeOriginalName('answers_name'),
            Text::make("Answers Name")->hideFromIndex()->hideWhenUpdating()->hideWhenCreating()->readonly(),
            BelongsTo::make('Course'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
