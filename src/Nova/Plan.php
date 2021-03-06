<?php

namespace SauloSilva\Plans\Nova;

use Laravel\Nova\Fields\HasMany;
use SauloSilva\Plans\Nova\Actions\ChangeStatus;
use SauloSilva\Plans\Nova\Filters\PriorityFilter;
use SauloSilva\Plans\Nova\Filters\StatusFilter;
use SauloSilva\Plans\Nova\Lenses\PlansPerPriority;
use SauloSilva\Plans\Nova\Lenses\PlansPerType;
use SauloSilva\Plans\Nova\Metrics\TotalSaved;
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
use Laravel\Nova\Fields\Badge;
use App\Nova\Resource;

class Plan extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'SauloSilva\Plans\Models\Plan';

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
        'id', 'name'
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
            ID::make()->sortable(),

            Text::make('Nome', 'name')
                ->rules('required')
                ->sortable(),

            Textarea::make('Descrição', 'description')
//                ->rules('required')
                ->hideFromIndex(),

            Money::make('Valor Total', 'BRL', 'total')
                ->sortable(),

            Date::make('Criado em', 'created_at')
                ->format('DD/MM/YYYY')
                ->onlyOnDetail()
                ->sortable(),

            new Panel('Informação Adicional', $this->configFields()),

            new Panel('Resumo', $this->resumeFields()),

            HasMany::make('Depósitos', 'planDeposits', 'SauloSilva\Plans\Nova\PlanDeposits'),

        ];
    }

    protected function resumeFields()
    {
        return [
            Money::make('Total Depositado', 'BRL', 'total_deposit')
                ->exceptOnForms(),

            Text::make('Percentual Depositado', function() {
                return number_format($this->total_percent, 2) . '%';
            })->exceptOnForms(),
        ];
    }

    protected function configFields()
    {
        return [
            RadioButton::make('Tipo', 'type')
                ->options([
                    'DREAM' => 'Sonho',
                    'ACQUISITION' => 'Aquisição',
                    'DEBT' => 'Dívida',
                    'WISH' => 'Desejos',
                ])
                ->default('ACQUISITION')
                ->rules('required')
                ->hideFromIndex()
                ->sortable(),
            // apenas teste
            Checkboxes::make('Direcionado', 'destination')
                ->options([
                    'CASA' => 'Casa',
                    'SAULO' => 'Saulo',
                    'RUTH' => 'Ruth',
                    'SOFIA' => 'Sofia',
                ])
                ->hideFromIndex()
                ->rules('required'),

            Date::make('Data para inicial', 'started_date')
                ->format('DD/MM/YYYY')
                ->hideFromIndex()
                ->sortable(),

            Date::make('Data de conclusão', 'completed_date')
                ->format('DD/MM/YYYY')
                ->hideFromIndex()
                ->sortable(),

            RadioButton::make('Situação', 'status')
                ->options(Plan::statusOptions())
                ->default('WAITING')
                ->onlyOnForms()
                ->rules('required'),

            Badge::make('Situação', 'status')
                ->exceptOnForms()
                ->labels(Plan::statusOptions())
                ->map([
                    'WAITING' => 'warning',
                    'IN_PROGRESS' => 'info',
                    'PAUSE' => 'warning',
                    'COMPLETED' => 'success',
                    'FAILED' => 'danger',
                ])
                ->sortable(),

            RadioButton::make('Prioridade', 'priority')
                ->options(Plan::priorityOptions())
                ->default('NORMAL')
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
        return [
//            (new TotalSaved())->onlyOnDetail()
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new StatusFilter(),
            new PriorityFilter()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            new PlansPerType(),
            new PlansPerPriority()
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new ChangeStatus()
        ];
    }
}
