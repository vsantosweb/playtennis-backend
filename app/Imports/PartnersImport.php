<?php

namespace App\Imports;

use App\Models\Partner;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PartnersImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {

            if ($row === 0) continue;

            Partner::updateOrCreate([
                'name' => $column[0],
                'phone' => $column[1],
                'website' => $column[2],
                'description' => $column[3],
            ]);
        }
    }
}
