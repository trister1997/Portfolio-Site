<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public $timestamps = false;
    protected $fillable = ['ip', 'visits'];
}
