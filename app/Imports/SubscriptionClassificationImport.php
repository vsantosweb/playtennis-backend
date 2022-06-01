<?php

namespace App\Imports;

use App\Models\Classification;
use App\Models\Subscription\Subscription;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SubscriptionClassificationImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {

            if ($row === 0) continue;

            $subscription = Subscription::where('name', $column[0])->first();

            if (!is_null($subscription)) {

                $classification = Classification::where('name', strtolower($column[1]))->first();

                $classification->subscriptions()->attach($subscription->id);
            }
        }
    }
}
