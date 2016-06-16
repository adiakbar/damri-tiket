<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class JenisBisTrayek extends Model {

	protected $table = 'jenis_bis_trayek';
    protected $fillable = ['trayek_id', 'jenis_bis_id', 'harga', 'jadwal', 'stasiun_asal', 'stasiun_tujuan', 'kode_trayek'];
    protected $hidden = ['trayek_id','created_at'];

    // public function setUpdatedAt($value){}

    public function getUpdatedAtColumn() {
        return null;
    }

    public function trayek()
    {
    	return $this->belongsTo('App\Trayek');
    }

    public function jenis_bis()
    {
    	return $this->belongsTo('App\JenisBis');
    }

    public function bis_default()
    {
        return $this->hasMany('App\BisDefault');
    }

    public function bis_berangkat()
    {
        return $this->hasMany('App\BisBerangkat');
    }

    public function getJadwalAttribute($value)
    {
        return substr($value,0,-3);
    }

}

?>