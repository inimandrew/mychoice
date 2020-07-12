<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pins extends Model
{
    protected $table = 'pins';
    protected $fillable = [
        'pin','campaign_id','used'
    ];


    public $timestamps = false;

    public function campaign(){
        return $this->hasOne(Campaign::class,'id','campaign_id');
    }
}
