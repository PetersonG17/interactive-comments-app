<?php

namespace Database\Migrations;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::schema()->create('user', function ($table) {
            $table->bigIncrements('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->text('body');
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
        //
    }
}
