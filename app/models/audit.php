<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audit_trail';
    protected $fillable = ['user_id', 'activity'];
}
