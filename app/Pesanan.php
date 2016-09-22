<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $fillable = ['penumpang', 'telephone', 'passport', 'tanggal', 'status', 
                           'keterangan','numeratur', 'petugas_id', 'jenis_bis_trayek_id', 
                           'kode_trayek', 'trayek_id', 'nomor_bis', 'nomor_kursi', 
                           'bis_id', 'domisili_asal', 'domisili_tujuan', 'masa_berlaku',
                           'tempat_lahir', 'tanggal_lahir'];
    protected $hidden = ['created_at', 'updated_at'];

    public function jenis_bis_trayek()
    {
    	return $this->belongsTo('App\JenisBisTrayek');
    }

    public function trayek()
    {
    	return $this->belongsTo('App\Trayek');
    }

    public function petugas()
    {
        return $this->belongsTo('App\User');
    }
}
