<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable=['name'];
    protected $hidden = ['pivot'];
    public function videos(){


        return $this->belongsToMany(Video::class,'tag_video');
    }
}
