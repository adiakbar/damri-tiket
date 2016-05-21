<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class BisBerangkat extends Model {

	protected $table = 'bis_berangkat';
    protected $fillable = ['jenis_trayek_bis_id', 'bis_id', 'tanggal', 'kode_trayek'];
    protected $hidden = ['created_at'];

    public function setUpdatedAt($value){}

    public function jenis_bis_trayek()
    {
    	return $this->belongsTo('App\JenisBisTrayek');
    }

    public function bis()
    {
    	return $this->belongsTo('App\Bis');
    }
}

?>