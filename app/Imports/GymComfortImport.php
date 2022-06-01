<?php

namespace App\Imports;

use App\Models\Comfort\Comfort;
use App\Models\Gym\Gym;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class GymComfortImport implements ToCollection
{
    /**
     * @param Collection $collection
     */

    protected $gym;

    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {
            if ($row === 0) continue;

            foreach ($column as $key => $value) {

                if ($key === 0) {
                    $this->gym = Gym::where('name', $value)->first();
                    continue;
                }
                
                if($value === 'yes'){
                    $this->gym->comforts()->attach($key);
                }
            }
        }
    }
}
