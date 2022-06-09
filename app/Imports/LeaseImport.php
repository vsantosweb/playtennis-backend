<?php

namespace App\Imports;

use App\Models\Ebook\Ebook;
use App\Models\Lease\Lease;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;

class LeaseImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $column) {
            if ($row === 0) continue;

            $lease = Lease::updateOrCreate(['name' => ucfirst($column[0]), 'business_id' => 3, 'description' => $column[1], 'description_1' =>  $column[2]]);

            Ebook::firstOrCreate([
                'name' => $lease->slug,
                'url' => Storage::disk('public')->url('ebooks/locacoes/') . 'locacoes.pdf'
            ]);
        }
    }
}
