<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;

class Course extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Course>
     */
    public static $model = \App\Models\Course::class;

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
            //     Boolean::make("Active", function() {
            //         return $this->cohort_id;
            // })->onlyOnDetail(),
            Text::make('Title')->sortable(),
            BelongsTo::make('Cohort')->nullable()->readonly()->help("Update the cohort by Publishing the course."),
            ID::make()->sortable()->hideFromDetail(),
            Text::make('Access Code'),
            BelongsTo::make("Article")->nullable()->hideFromIndex(),
            HasMany::make('Activities'),
            HasMany::make('Songs'),


        ];
    }

    // public function fieldsForDetail(NovaRequest $request)
    // {
    //     return [
    //         Boolean::make("Active", function() {
    //              return $this->cohort_id != null;
    //         }),
    //         Text::make('Title')->sortable(),
    //         Text::make('Access Code'),
    //         HasMany::make('Activities'),
    //         HasMany::make('Songs'),
    //         BelongsTo::make('Cohort')->nullable()->readonly()->help("Update the cohort by Publishing the course."),
    //     ];
    // }

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
        return [
               (new \App\Nova\Actions\PublishCourse)
                ->confirmText("Select a cohort to publish this course to...")
                ->confirmButtonText("Publish"),
        ];
    }
}
