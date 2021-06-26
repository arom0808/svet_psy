<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function quotes()
    {
        return $this->hasMany('App\Models\Quote', 'category_id', 'id');
    }
}
