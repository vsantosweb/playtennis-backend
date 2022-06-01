<?php

namespace App\Imports;

use App\Models\Workout\Workout;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class WorkoutImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {

            if ($row === 0) continue;
            Workout::updateOrCreate(['name' => ucfirst($column[0]), 'business_id' => 1, 'description' => $column[1]]);
        }
    }
}
