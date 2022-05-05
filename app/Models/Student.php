<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;


    public function users()
    {

        return $this->belongsToMany(User::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
