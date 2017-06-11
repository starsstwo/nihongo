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

    public function scopeLists($query, $id)
    {
        return $query
            ->selectRaw('kotobas.id as id, name, phonetic, group_concat(imis.mean) as mean')
            ->join('imis', 'kotobas.id', '=', 'imis.kotoba_id')
            ->where('user_id', $id)->groupBy('kotobas.id');
    }
}
