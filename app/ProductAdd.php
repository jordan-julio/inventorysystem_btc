<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductAdd extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'product_id', 'qty'
    ];
    public function transactions() {
        return $this->hasMany('App\Transaction');
    }
    public function products() {
        return $this->hasMany('App\SoldProduct');
    }
    public function product() {
        return $this->belongsTo('App\Product');
    }
}
