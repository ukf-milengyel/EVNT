<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcement';
    public $timestamps = true;

    protected $fillable = [
        'body',
        'image',
        'event_id',
    ];

    public function event(){
        return $this->hasMany(Event::class);
    }
}
