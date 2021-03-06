<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

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
