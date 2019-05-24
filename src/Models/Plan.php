<?php

namespace SauloSilva\Plans\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $casts = [
        'destination' => 'array'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['planned_date', 'started_date', 'completed_date'];

    public function planDeposits()
    {
        return $this->hasMany(PlanDeposit::class);
    }

    public function getTotalDepositAttribute($value)
    {
        return $this->planDeposits->sum('value');
    }

    public function getTotalPercentAttribute($value)
    {
        if ($this->total_deposit > 0) {
            return ($this->total_deposit * 100) / $this->total;
        }
        
        return 0;
    }

    /*
     * Options to radio ou checkbox
     */
    public static function statusOptions()
    {
        return [
            'WAITING' => 'Aguardando',
            'IN_PROGRESS' => 'Em andamento',
            'PAUSE' => 'Pausado',
            'COMPLETED' => 'Concluído',
            'FAILED' => 'Falhou',
        ];
    }

    public function changeStatus($status)
    {
        $this->status = $status;

        $this->save();
    }
}
