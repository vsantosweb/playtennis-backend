<?php

namespace App\Imports;

use App\Models\Classification;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ClassificationImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {

            if ($row === 0) continue;
            Classification::updateOrCreate(['name' => ucfirst($column[0])]);
        }
    }
}
