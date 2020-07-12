<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    protected $table = "positions";

    protected $fillable = ['name'];

    public $timestamps = false;



    public function contestants(){
        return $this->hasMany(Contestants::class,'position_id','id');
    }
}
