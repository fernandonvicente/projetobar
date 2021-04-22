<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->increments('id');

            $table->text('name');
            $table->text('address');
            $table->text('num');
            $table->date('complement');
            $table->text('neighborhood');
            $table->integer('city_id');
            $table->text('city');
            $table->integer('state_id');
            $table->text('zip_code');
            $table->integer('ibge');
            $table->text('phone');
            $table->text('email');

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
        Schema::dropIfExists('forums');
    }
}
