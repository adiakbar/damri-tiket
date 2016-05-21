<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBisBerangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bis_berangkat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_trayek_bis_id');
            $table->integer('bis_id');
            $table->date('tanggal');
            $table->string('nomor_bis', 50);
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
        Schema::drop('bis_berangkat');
    }
}
