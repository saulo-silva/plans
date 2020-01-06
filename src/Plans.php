<?php

namespace SauloSilva\Plans;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use SauloSilva\Plans\Nova\Plan;
use SauloSilva\Plans\Nova\PlanDeposits;
use Anaseqal\NovaImport\NovaImport;

class Plans extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('plans', __DIR__.'/../dist/js/tool.js');
        Nova::style('plans', __DIR__.'/../dist/css/tool.css');

        Nova::resources([
            Plan::class,
            PlanDeposits::class,
        ]);
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('plans::navigation');
    }
}
