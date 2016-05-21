<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Trayek extends Model {

	protected $table = 'trayek';
    protected $fillable = ['asal', 'tujuan', 'alias_alas', 'alias_tujuan', 'alias', 'slug_alias'];
    protected $hidden = ['created_at'];

    public function setUpdatedAt($value){}

    public function jenis_bis_trayek()
    {
    	return $this->hasMany('App\JenisBisTrayek');
    }

}

?>