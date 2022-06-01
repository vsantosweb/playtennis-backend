<?php

namespace App\Imports;

use App\Models\TennisCourt\TennisCourt;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TennisCourtImport implements ToCollection
{
    /**
     * @param Collection $collection
     */


    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {
            
            if ($row === 0) continue;

            TennisCourt::updateOrCreate([ 'name' => $column[0] ]);
        }
    }
}
