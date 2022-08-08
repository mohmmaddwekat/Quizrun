<?php

namespace App\Models;

use App\Models\Teacher\Group;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function formatDate()
    {
        return Carbon::parse($this->date)->toDateTime();
    }
}
