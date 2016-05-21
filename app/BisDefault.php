<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class BisDefault extends Model {

	protected $table = 'bis_default';
    protected $fillable = ['jenis_trayek_bis_id', 'kode_trayek_bis'];
    protected $hidden = ['created_at'];

    public function setUpdatedAt($value){}

    public function jenis_bis_trayek()
    {
    	return $this->belongsTo('App\JenisBisTrayek');
    }

}

?>