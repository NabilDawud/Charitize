<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $guarded = [];
    public function donner()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function cause()
    {
        return $this->belongsTo(Cause::class)->withDefault();
    }
}
