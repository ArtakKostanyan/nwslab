<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable=['name','desc','embed'];

    protected $hidden = ['pivot'];
    public function images(){

        return $this->hasMany(Image::class);
    }

    public function tags(){

        return $this->belongsToMany(Tag::class,'tag_video');

    }
}
