<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makan extends Model
{
    protected $table = 'makans';
    protected $fillable = ['id_user','jadwal','status'];
}
