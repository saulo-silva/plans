<?php

namespace SauloSilva\Plans\Nova\Lenses;

//use Inspheric\Fields\Indicator;
use OwenMelbz\RadioField\RadioButton;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Vyuldashev\NovaMoneyField\Money;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Http\Requests\LensRequest;
use SauloSilva\Plans\Nova\Plan;
use Illuminate\Support\Facades\DB;

class PlansPerType extends Lens
{
    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->select(self::columns())
                ->groupBy( 'type')
                ->orderBy('total', 'Desc')
        ));
    }

    /**
     * Get the columns that should be selected.
     *
     * @return array
     */
    protected static function columns()
    {
        return [
            'id',
            'type',
            DB::raw('sum(total) as total'),
        ];
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
//            ID::make('ID', 'id')->sortable(),
            Money::make('Valor Total', 'BRL', 'total')
                ->sortable(),
            RadioButton::make('Tipo', 'type')
                ->options([
                    'DREAM' => 'Sonho',
                    'ACQUISITION' => 'Aquisição',
                    'DEBT' => 'Dívida',
                    'WISH' => 'Desejos',
                ])
                ->sortable(),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'plans-per-type';
    }
}
