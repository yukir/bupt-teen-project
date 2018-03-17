<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimestampToken extends Model
{
    //模型关联
    public function activity() {
        return $this->belongsTo('App\Activity');
    }
}
