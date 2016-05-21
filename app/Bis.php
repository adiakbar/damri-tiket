<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Bis extends Model {

	protected $table = 'bis';
    protected $fillable = ['kode', 'plat'];
    protected $hidden = ['created_at'];

    public function setUpdatedAt($value){}

    public function bis_berangkat()
    {
    	return $this->hasMany('App\BisBerangkat');
    }
}

?>