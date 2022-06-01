<?php

namespace App\Imports;

use App\Models\Lease\Lease;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class LeaseImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {
            if ($row === 0) continue;
            Lease::updateOrCreate(['name' => ucfirst($column[0]), 'business_id' => 3, 'description' => $column[1],'description_1' =>  $column[2]]);
        }
    }
}
