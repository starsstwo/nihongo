<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KotobaModel extends Model
{
    protected $table = 'kotobas';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function imi()
    {
        return $this->hasMany('App\ImiModel', 'kotoba_id');
    }
}
