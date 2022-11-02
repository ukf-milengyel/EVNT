<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';
    public $timestamps = true;

    protected $fillable = [
        "name",
        "description",
        "user_id",
        "date",
        "organizer",
        "location_name",
        "location_address",
        "image"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
