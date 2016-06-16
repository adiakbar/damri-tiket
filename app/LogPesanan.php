<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class LogPesanan extends Model {

	protected $table = 'log_pesanan';

	// public function setUpdatedAt($value){}

	public function getUpdatedAtColumn() {
        return null;
    }

    public function jenis_bis_trayek()
    {
    	return $this->belongsTo('App\JenisBisTrayek');
    }

    
}

?>