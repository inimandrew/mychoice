<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contestants extends Model
{
    protected $table ="contestants";
    protected $fillable = [
        'firstname','lastname','department','position_id','campaign_id',
    ];
    public $timestamps = false;

    public function campaign(){
        return $this->hasOne(Campaign::class,'id','campaign_id');
    }

    public function votes(){
        return $this->hasMany(Votes::class,'contestant_id','id');
    }
}
