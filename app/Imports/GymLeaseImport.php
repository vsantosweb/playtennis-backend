<?php

namespace App\Imports;

use App\Models\Gym\Gym;
use App\Models\Lease\Lease;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class GymLeaseImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $invalid = [];
        foreach ($collection as $row => $column) {

            if ($row === 0) continue;
            $lease = Lease::where('name', $column[1])->first();

            $gym = Gym::where('name', $column[0])->first();
           
            if (is_null($gym)) {
                $invalid[] = $column[0];
            }
            if (!is_null($lease) && !is_null($gym)) :
                $gym->leases()->attach($lease->id);
            endif;
        }
    }
}
