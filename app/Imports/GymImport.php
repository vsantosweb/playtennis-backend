<?php

namespace App\Imports;

use App\Models\Gym\Gym;
use App\Models\Locale\City;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class GymImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        foreach ($collection as $row => $column) {

            if ($row === 0) continue;

            Gym::updateOrCreate([
                'name' => $column[0],
                'city_id' => City::where('name', $column[2])->first()->id,
                'state' => $column[1],
                'city' => $column[2],
                'geolocation' => $column[3],
                'address_1' => $column[4],
                'address_2' => $column[0],
                'locality' => $column[5],
                'phone' => $column[6],
                'is_main' => $column[0] === 'Morumbi' ? 1 : 0,
                'email' => $column[7],
                'description' => $column[8],
                'is_school' => $column[9] == 'Sim' ? true : false
            ]);
        }
    }
}
