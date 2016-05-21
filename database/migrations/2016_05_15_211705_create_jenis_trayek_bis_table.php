<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisTrayekBisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_trayek_bis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trayek_id');
            $table->integer('jenis_bis_id');
            $table->double('harga');
            $table->string('jadwal', 50);
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
        Schema::drop('jenis_trayek_bis');
    }
}
