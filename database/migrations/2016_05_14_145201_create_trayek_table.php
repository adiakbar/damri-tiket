<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrayekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trayek', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asal')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('alias_asal')->nullable();
            $table->string('alias_tujuan')->nullable();
            $table->string('alias')->nullable();
            $table->string('slug_alias')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trayek');
    }
}
