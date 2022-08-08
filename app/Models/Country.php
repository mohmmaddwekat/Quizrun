<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code'
    ];
    public function teacher()
    {
        return $this->hasMany(teacher::class);
    }
    public function user()
    {
        return $this->hasMany(user::class);
    }
}
