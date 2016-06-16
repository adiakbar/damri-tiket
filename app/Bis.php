<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Bis extends Model {

	protected $table = 'bis';
    protected $fillable = ['jenis_bis_id', 'plat', 'jumlah_kursi'];
    protected $hidden = ['created_at'];

    // public function setUpdatedAt($value){}

    public function getUpdatedAtColumn() {
        return null;
    }

    public function bis_berangkat()
    {
    	return $this->hasMany('App\BisBerangkat');
    }

    public function jenis_bis()
    {
    	return $this->belongsTo('App\JenisBis');
    }
}

?>