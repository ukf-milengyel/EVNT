<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function event() {
        return $this->belongsToMany(Event::class, 'event_has_tag');
    }
}
