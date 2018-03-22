<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Activity;
    
class CommentsTableSeeder extends Seeder
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
        if (Activity::count() == 0) {
            echo "[Seeder]请确保活动表不为空！";
            return;
        }
        factory(App\Comment::class, 100)->create();
        echo "[Seeder]已注入 100 个测试评论.";
    }
}
