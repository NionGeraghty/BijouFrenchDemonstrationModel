<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

use App\Models\Cohort;
use App\Models\Course;

class PublishCourse extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $models->each(function ($model) use ($fields) {
            // find the course from $model
            $course = $model;
            $cohort_id = $fields->cohort_id;

            // remove this cohort id from courses where set
            $courses = Course::where('cohort_id', $cohort_id)->get();
            foreach ($courses as $C) {
                $C->cohort_id = null;
                $C->save();
            }

            // update the cohort_id
            $course->cohort_id = $fields->cohort_id;
            $course->save();
        });

    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        // grab all cohorts and make select options
        $cohorts = Cohort::all();
        return [
            Select::make('Cohort', 'cohort_id')
                ->options(
                    $cohorts->pluck( 'title', 'id')->toArray()
                )
        ];
    }
}
