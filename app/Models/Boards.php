<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boards extends Model
{
    protected $table = 'Boards';

    protected $fillable = ['id','integer','string'];
}
