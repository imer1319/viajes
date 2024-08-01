<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    protected $roles = [
        [
            'name' => 'ADM',
            'description' => 'ADMINISTRADOR',
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->roles)->each(function ($rol) {
            Role::create($rol);
        });
    }
}
