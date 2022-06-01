<?php

namespace App\Imports;

use App\Models\Gym\Gym;
use App\Models\TennisCourt\TennisCourt;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;

class GymCourtImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    protected $gym;
    protected $tennisCourt;

    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {

            if ($row === 0) continue;

            $this->gym = Gym::where('slug', Str::slug($column[0]))->first();
            
            $this->gym->tennisCourts()->syncWithoutDetaching(
                [TennisCourt::where('name', $column[1])->first()->id => ['indoor' => $column[2], 'outdoor' => $column[3]]]
            );
            
        }
    }
}
