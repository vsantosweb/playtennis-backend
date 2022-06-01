<?php

namespace App\Imports;

use App\Models\Benefit\Benefit;
use App\Models\Subscription\Subscription;
use App\Models\Workout\Workout;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BenefitsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        foreach ($collection as $row => $column) :

            $benefit = Benefit::updateOrcreate(['name' => $column[1]]);

            $workout = Workout::where('name', $column[0])->first();

            if (!is_null($workout)) {

                $workout->benefits()->attach($benefit->id);
            }

            $subscription = Subscription::where('name', $column[0])->first();

            if (!is_null($subscription)) {

                $subscription->benefits()->attach($benefit->id);
            }

        endforeach;
    }
}
