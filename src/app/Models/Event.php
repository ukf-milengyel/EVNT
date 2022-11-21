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

    public function tag() {
        return $this->belongsToMany(Tag::class, 'event_has_tag');
    }

    public function user_a() {
        return $this->belongsToMany(User::class, 'user_attends_event');
    }

    public function image() {
        return $this->hasMany(Image::class);
    }

    public function attachment() {
        return $this->hasMany(Attachment::class);
    }

    public function announcement() {
        return $this->hasMany(Announcement::class);
    }

}
