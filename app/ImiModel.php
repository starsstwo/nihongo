<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImiModel extends Model
{
    protected $table = 'imis';

    public function kotoba()
    {
        return $this->belongsTo('App\KotobaModel');
    }
}
