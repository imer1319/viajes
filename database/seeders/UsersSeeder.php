<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            [
                'name' => 'Ada Lovelance',
                'email' => 'admin@test.test',
                'password' => bcrypt('secret')
            ]);
        $user->assignRole('ADM');
    }
}
