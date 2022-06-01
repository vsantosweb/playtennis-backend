<?php

namespace App\Imports;

use App\Models\Gym\Gym;
use App\Models\Subscription\Subscription;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class GymSubscriptionImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $list = [];
        foreach ($collection as $row => $column) {

            if ($row === 0) continue;
            $gym = Gym::where('name', $column[0])->first();

            if (!is_null($gym)) {
                $list[] = $column[0];
                $subscription = Subscription::where('name', strtolower($column[1]))->first();

                $gym->subscriptions()->attach($subscription->id);
            }
        }
    }
}
