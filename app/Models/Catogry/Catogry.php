<?php

namespace App\Models\Catogry;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catogry extends Model
{
    //
    use SoftDeletes ;

    protected $table='catogries';
    protected $guarded = [];
}
