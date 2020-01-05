<?php

namespace SauloSilva\Plans\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;
use SauloSilva\Plans\Models\Plan;

class StatusFilter extends BooleanFilter
{

    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Situação';
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'boolean-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        $items = collect($value);
        $searchStatus = $items->filter(function ($item) {
            return $item === true;
        });

        if ($searchStatus->count() === 0) {
            return $query;
        }

        return $query->whereIn('status', $searchStatus->keys());
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $options = Plan::statusOptions();

        return array_flip($options);
    }

    /**
     * Set the default options for the filter.
     *
     * @return array|mixed
     */
    public function default()
    {
        return [
            'IN_PROGRESS' => true
        ];
    }
}
