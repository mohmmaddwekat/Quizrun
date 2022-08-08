<?php

namespace App\Models\Admin;

use App\Models\Teacher\Group;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function groups()
    {

        return $this->hasMany(Group::class);
    }
}
