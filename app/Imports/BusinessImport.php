<?php

namespace App\Imports;

use App\Models\Business\Business;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BusinessImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        foreach ($collection as $row => $column) {

            if ($row === 0) continue;

            Business::updateOrCreate(['name' => ucfirst($column[0])]);
        }
    }
}
