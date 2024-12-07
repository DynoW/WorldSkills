<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['fullname', 'email', 'phone', 'event_id'];
    public $timestamps = false;
}
