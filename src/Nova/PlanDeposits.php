<?php

namespace SauloSilva\Plans\Nova;

use Laravel\Nova\Fields\DateTime;
use SauloSilva\Plans\Nova\Actions\Plan\ChangeStatus;
use SauloSilva\Plans\Nova\Filters\Plan\StatusFilter;
use Vyuldashev\NovaMoneyField\Money;
use Laravel\Nova\Fields\Date;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use OwenMelbz\RadioField\RadioButton;
use Laravel\Nova\Http\Requests\NovaRequest;
use Inspheric\Fields\Indicator;
use App\Nova\Resource;

class PlanDeposits extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'SauloSilva\Plans\Models\PlanDeposit';

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(),

            Money::make('Valor', 'BRL', 'value'),

            DateTime::make('Criado em', 'created_at')
                ->format('DD/MM/YYYY HH:mm:ss')
                ->exceptOnForms()
                ->rules('required'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }
}
