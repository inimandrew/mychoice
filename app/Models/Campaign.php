<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns';

    protected $fillable = ['name','status','year'];

    public function pins(){
        return $this->hasMany(Pins::class,'campaign_id','id');
    }
}
