<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'uploader_id'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
