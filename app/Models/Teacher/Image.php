<?php

namespace App\Models\teacher;

use App\Models\Teacher\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
