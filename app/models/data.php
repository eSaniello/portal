<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';
    protected $fillable = ['id', 'user_id', 'number', 'code', 'start_date', 'end_date', 'num1', 'percent', 'num2', 'expiry_date'];
}
