<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_bis_id');
            $table->string('plat', 50);
            $table->integer('jumlah_kursi');
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
        Schema::drop('bis');
    }
}
