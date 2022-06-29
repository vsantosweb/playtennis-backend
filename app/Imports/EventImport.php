<?php

namespace App\Imports;

use App\Models\Event\Event;
use App\Models\Event\EventCategory;
use App\Models\Gym\Gym;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;

class EventImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {

            if ($row === 0) continue;

            $start = (new Carbon(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($column[2])))->format('Y-m-d H:i:s');
            $end = (new Carbon(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($column[3])))->format('Y-m-d H:i:s');

            $startRegister = (new Carbon(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($column[4])))->format('Y-m-d');
            $endRegister = (new Carbon(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($column[5])))->format('Y-m-d');

            $eventCategory = EventCategory::firstOrcreate(['name' => $column[1]]);

            $event = $eventCategory->events()->firstOrCreate(['name' => $column[0], 'description' => $column[8]]);

            $gym = Gym::where('name', $column[7])->first();

            $gym->events()->syncWithoutDetaching(
                [
                    $event->id => [
                        'code' => sha1(Str::random(12)),
                        'start_at' => $start,
                        'end_at' => $end,
                        'registration_start_date' => $startRegister,
                        'registration_end_date' => $endRegister,
                        'vacancies' => $column[6],
                    ]
                ]
            );
        }
    }
}
