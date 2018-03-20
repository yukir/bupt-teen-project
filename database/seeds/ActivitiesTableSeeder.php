<?php

use Illuminate\Database\Seeder;
use App\User; 

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0 || !User::find(1)->isSuperAdmin()) {
            echo "[Seeder]请确保用户表中第一个用户拥有admin权限！";
            return;
        }
        factory(App\Activity::class, 50)->create();
        echo "[Seeder]已注入 50 个测试活动.";
    }
}
