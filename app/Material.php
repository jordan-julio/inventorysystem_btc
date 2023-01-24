<?php
#PRODUCTS ADD DATA
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'material_id', 'matAmount', 'matDefect', 'price', 'DateAdded'
    ];

}
