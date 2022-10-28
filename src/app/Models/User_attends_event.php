<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_attends_event extends Model
{
    use HasFactory;

    protected $table = 'user_attends_event';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'event_id',
    ];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function event(){
        return $this->hasMany(Event::class);
    }
}
