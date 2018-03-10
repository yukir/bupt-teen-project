<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('yiban_id')->nullable();
            //易班绑定后
            $table->string('username')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->boolean('super_admin')->default(0); //拥有所有权限不解释
            $table->boolean('sxyl_admin')->default(0); //思想引领-主题教育相关全部权限
            $table->boolean('xxst_admin')->default(0); //思想引领-学习社团相关全部权限
            $table->boolean('zttr_xtw')->default(0); //基层团建-主题团日相关校团委全部权限
            $table->boolean('zttr_tzs')->default(0); //基层团建-主题团日相关团支书全部权限
            $table->boolean('zttr_tgpx')->default(0); //基层团建-团干培训全部权限
            $table->boolean('zttr_admin')->default(0); //基层团建"上级团组织" 可以管理团组织 拥有基层团建最高权限
            $table->boolean('xywh_admin')->default(0); //校园文化全部权限
            $table->boolean('banned')->default(0); //被封禁用户
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
