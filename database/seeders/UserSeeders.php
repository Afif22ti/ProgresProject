<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'nama'=> 'Admin',
                'role'=> 'admin',
                'email' => 'afif22ti@mahasiswa.pcr.ac.id',
                'password'=> bcrypt('12345678')
            ],

            [
                'nama' => 'User',
                'role' => 'user',
                'email' => 'zaler@gmail.com',
                'password' => bcrypt('12345678')
            ],
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
