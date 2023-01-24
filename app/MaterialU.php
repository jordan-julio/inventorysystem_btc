<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialU extends Model
{
    protected $fillable = [
        'user_id', 'DateAdded','PotNo','product_id', 'product_name'
    ];
    public function usedmaterial() {
        return $this->hasMany('App\UsedMaterial');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
}