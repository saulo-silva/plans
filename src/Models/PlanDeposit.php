<?php

namespace SauloSilva\Plans\Models;

use Illuminate\Database\Eloquent\Model;

class PlanDeposit extends Model
{
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
