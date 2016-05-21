<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('penumpang');
            $table->string('handphone');
            $table->date('tanggal');
            $table->integer('petugas_id');
            $table->integer('jenis_trayek_bis');
            $table->integer('bis_id');
            $table->string('nomor_bis', 50);
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
        Schema::drop('pesanan');
    }
}
