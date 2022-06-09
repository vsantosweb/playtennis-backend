<?php

namespace App\Imports;

use App\Models\Ebook\Ebook;
use App\Models\Subscription\Subscription;
use App\Models\Workout\Workout;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
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

            $subscription = Subscription::updateOrCreate(['name' => ucfirst($column[0]), 'business_id' => 2, 'description' => $column[1]]);

            Ebook::firstOrCreate([
                'name' => $subscription->slug,
                'url' => Storage::disk('public')->url('ebooks/assinaturas/') . $subscription->slug . '.pdf'
            ]);
        }
    }
}
