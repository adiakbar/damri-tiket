<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class JenisBis extends Model {

	protected $table = 'jenis_bis';
    protected $fillable = ['jenis', 'slug_jenis'];
    protected $hidden = ['created_at'];

    public function setUpdatedAt($value){}

    // public function jenis_bis_trayek()
    // {
    // 	return $this->hasMany('App\JenisBisTrayek');
    // }

}

?>