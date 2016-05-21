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
            $table->string('asal', 100);
            $table->string('tujuan', 100);
            $table->string('alias_asal', 100);
            $table->string('alias_tujuan', 100);
            $table->string('alias', 100);
            $table->string('slug_alias', 100)->index();
            $table->timestamp('created_at');
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
