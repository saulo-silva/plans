<?php

namespace SauloSilva\Plans\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use SauloSilva\Plans\Models\Plan;

class PriorityFilter extends Filter
{

    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Prioridade';
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

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
        return $query->where('priority', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $options = Plan::priorityOptions();

        return array_flip($options);
    }
}
