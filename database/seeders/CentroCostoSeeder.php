<?php

namespace Database\Seeders;

use App\Models\CentroCosto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CentroCostoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CentroCosto::factory(15)->create();
    }
}
