<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $table = 'attachment';
    public $timestamps = true;

    protected $fillable = [
        'event_id',
        'filename',
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
