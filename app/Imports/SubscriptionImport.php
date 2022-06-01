<?php

namespace App\Imports;

use App\Models\Subscription\Subscription;
use App\Models\Workout\Workout;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SubscriptionImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {

            if ($row === 0) continue;
            Subscription::updateOrCreate(['name' => ucfirst($column[0]), 'business_id' => 2, 'description' => $column[1]]);
        }
    }
}
