<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded = [];

    protected $with = ['image'];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'btn1_text' => 'array',
        'btn2_text' => 'array',
    ];
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function getTitleTransAttribute()
    {
        return $this->title[app()->getLocale()] ?? null;
    }
}
