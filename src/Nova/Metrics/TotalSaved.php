<?php

namespace SauloSilva\Plans\Nova\Metrics;

use DB;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;
use SauloSilva\Plans\Models\PlanDeposit;

class TotalSaved extends Value
{
    public $name = 'Total Poupado';

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->sum($request, PlanDeposit::whereMonth('created_at', DB::raw('MONTH(NOW())')), 'value', 'created_at')
            ->currency('R$')
            ->suffix('no mês');
//        return $this->sum($request, PlanDeposit::whereMonth('created_at', DB::raw('MONTH(NOW())')), 'value', 'created_at')
//                    ->currency('R$')
//                    ->suffix('no mês');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
//            30 => '30 Days',
//            60 => '60 Days',
//            365 => '365 Days',
//            'MTD' => 'Month To Date',
//            'QTD' => 'Quarter To Date',
//            'YTD' => 'Year To Date',
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'total-saved';
    }
}
