<?php
#PRODUCTS ADD DATA
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialH extends Model
{
    protected $fillable = [
        'material', 'TotalmatAmount', 'TotalmatDefect'
    ];
    public function usedmaterial()
    {
        return $this->hasMany('App\UsedMaterial');
    }
}
