<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    protected $table = 'votes';

    protected $fillable = [
        'campaign_id','pin_id','contestant_id'
    ];
}
