<?php

namespace SauloSilva\Plans\Imports;

use SauloSilva\Plans\Models\Plan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PlansImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            logger($row);
//            User::create([
//                'name' => $row[0],
//            ]);
        }
    }
}
