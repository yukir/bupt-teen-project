<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYibanUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yiban_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('yiban_id');
            $table->integer('school_id');
            $table->string('yiban_name');
            $table->string('real_name');
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
        Schema::dropIfExists('yiban_users');
    }
}
