<?php

namespace Database\Seeders;

use App\Models\Customer\CustomerStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $status = ['Ativo', 'Pendente', 'Desativado'];
        collect($status)->map(fn ($name) => CustomerStatus::firstOrcreate(['name' => $name]));
    }
}
