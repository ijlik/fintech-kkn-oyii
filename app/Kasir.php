<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    protected $table = 'kasirs';
    protected $fillable = ['id_user','status'];
}
