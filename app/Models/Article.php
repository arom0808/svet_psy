<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function publisher()
    {
        return $this->belongsTo('App\Models\User', 'publisher_id', 'id');
    }

    public function previewPhotoPathURL(){
        return Storage::url($this->preview_photo_path);
    }

    public function htmlFilePathURL(){
        return Storage::url($this->html_file_path);
    }
}
