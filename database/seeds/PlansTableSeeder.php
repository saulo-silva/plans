<?php

use Illuminate\Database\Seeder;
use SauloSilva\Plans\Models\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Plan::class, 20)->create();
    }
}
