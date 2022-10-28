<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_has_tag extends Model
{
    use HasFactory;

    protected $table = 'event_has_tag';
    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'tag_id',
    ];

    public function event(){
        return $this->hasMany(Event::class);
    }

    public function tag(){
        return $this->hasMany(Tag::class);
    }
}
