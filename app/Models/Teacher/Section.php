<?php

namespace App\Models\Teacher;

use App\Models\teacher\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function image()
    {
        return $this->hasMany(Image::class);
    }
    public function video()
    {
        return $this->hasMany(Video::class);
    }
}
