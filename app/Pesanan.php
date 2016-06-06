<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $fillable = ['penumpang', 'telephone', 'passport', 'tanggal', 'status', 'keterangan',
    					   'numeratur', 'petugas_id', 'jenis_bis_trayek_id', 'kode_trayek', 'nomor_bis', 
    					   'nomor_kursi', 'bis_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function jenis_bis_trayek()
    {
    	return $this->belongsTo('App\JenisBisTrayek');
    }
}
