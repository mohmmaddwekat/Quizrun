<?php

namespace App\Models;

use App\Models\Teacher\Group;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class Teacher extends DefaultUser implements MustVerifyEmail
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'certificate',
        'job',
        'skills',
        'location_id',
        'education',
        'experience',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function groups()
    {
        return $this->hasMany(Group::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Send a password reset notification to the teacher.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {

        $this->notify(new ResetPasswordNotification($token, 'teacher'));
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification('teacher'));
    }
}
