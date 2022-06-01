<?php

namespace App\Imports;

use App\Models\Comfort\Comfort;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ComfortImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {

            if ($row === 0) continue;

            Comfort::updateOrCreate(['name' => $column[0]]);
        }
    }
}
