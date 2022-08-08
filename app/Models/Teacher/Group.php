<?php

namespace App\Models\Teacher;

use App\Models\Admin\Category;
use App\Models\Forum;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'teacher_id',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function forum()
    {
        return $this->hasOne(Forum::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'group_user');
    }
}
