<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class BisDefault extends Model {

	protected $table = 'bis_default';
    protected $fillable = ['jenis_bis_trayek_id', 'kode_trayek', 'nomor_bis', 'jumlah_kursi', 'slug_jenis_bis'];
    protected $hidden = ['created_at', 'updated_at'];

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