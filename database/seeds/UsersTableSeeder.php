<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin', 
            'password' => bcrypt('admin'),
            'super_admin' => 1,
        ]);
        
        DB::table('users')->insert([
            'username' => 'demo', 
            'password' => bcrypt('demo'),
        ]);
    }
}
