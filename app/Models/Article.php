<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $guarded = [];

    public function publisher()
    {
        return $this->belongsTo('App\Models\User', 'publisher_id', 'id');
    }

    use HasFactory;
}
