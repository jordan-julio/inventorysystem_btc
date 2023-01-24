<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedMaterial extends Model
{
    protected $fillable = [
        'material_u_id', 'mat_id', 'qty'
    ];
    
    public function materialh()
    {
        return $this->belongsTo('App\MaterialH', 'mat_id');
    }
    public function materialu()
    {
        return $this->belongsTo('App\MaterialU');
    }
}
