<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::where('username','admin')->count() == 0)
            DB::table('users')->insert([
                'username' => 'admin', 
                'password' => bcrypt('admin'),
                'super_admin' => 1,
            ]);
        if (User::where('username','demo')->count() == 0)
            DB::table('users')->insert([
                'username' => 'demo', 
                'password' => bcrypt('demo'),
            ]);
        if (User::where('username','sxyl_admin')->count() == 0)
            DB::table('users')->insert([
                'username' => 'sxyl_admin', 
                'password' => bcrypt('123456'),
                'sxyl_admin' => 1,
            ]);
        if (User::where('username','xxst_admin')->count() == 0)
            DB::table('users')->insert([
                'username' => 'xxst_admin', 
                'password' => bcrypt('123456'),
                'xxst_admin' => 1,
            ]);
        if (User::where('username','zttr_xtw')->count() == 0)
            DB::table('users')->insert([
                'username' => 'zttr_xtw', 
                'password' => bcrypt('123456'),
                'zttr_xtw' => 1,
            ]);
        if (User::where('username','zttr_tzs')->count() == 0)
            DB::table('users')->insert([
                'username' => 'zttr_tzs', 
                'password' => bcrypt('123456'),
                'zttr_tzs' => 1,
            ]);
        if (User::where('username','zttr_tgpx')->count() == 0)
            DB::table('users')->insert([
                'username' => 'zttr_tgpx', 
                'password' => bcrypt('123456'),
                'zttr_tgpx' => 1,
            ]);
        if (User::where('username','zttr_admin')->count() == 0)
            DB::table('users')->insert([
                'username' => 'zttr_admin', 
                'password' => bcrypt('123456'),
                'zttr_admin' => 1,
            ]);
        if (User::where('username','xywh_admin')->count() == 0)
            DB::table('users')->insert([
                'username' => 'xywh_admin', 
                'password' => bcrypt('123456'),
                'xywh_admin' => 1,
            ]);
        if (User::where('username','banned')->count() == 0)
            DB::table('users')->insert([
                'username' => 'banned', 
                'password' => bcrypt('banned'),
                'banned' => 1,
            ]);
        echo "[Seeder]已向数据库注入所有测试用户.";
    }
}
