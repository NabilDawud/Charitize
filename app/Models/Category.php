<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded = [];

    protected $casts = [
        'title' => 'array',
    ];

    public function getTitleTransAttribute()
    {
        return $this->title[app()->getLocale()] ?? null;
    }
    public function causes()
    {
        return $this->hasMany(Cause::class);
    }
}
