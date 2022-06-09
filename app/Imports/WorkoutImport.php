<?php

namespace App\Imports;

use App\Models\Ebook\Ebook;
use App\Models\Workout\Workout;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;

class WorkoutImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {

            if ($row === 0) continue;
            $workout = Workout::updateOrCreate(['name' => ucfirst($column[0]), 'business_id' => 1, 'description' => $column[1]]);

            Ebook::firstOrCreate([
                'name' => $workout->slug,
                'url' => Storage::disk('public')->url('ebooks/aulas/') . $workout->slug . '.pdf'
            ]);
        }
    }
}
