<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','capacity','duration','schedule','instructor_name',
    ];

    /* Add User - Role Relation */
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
