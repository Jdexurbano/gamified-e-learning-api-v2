<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name'=>'Admin',
            'last_name'=>'Admin',
            'middle_initial'=>'A',
            'student_No'=>'25-0000',
            'age'=>'25',
            'address'=>'Malasiqui,Pangasinan',
            'username'=>'admin',
            'password'=>Hash::make('useradmin'),
            'role'=>'admin',
        ]);
    }
}
