<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'group';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'permissions',
        'color',
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
}
