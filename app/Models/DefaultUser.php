<?php

namespace App\Models;

use App\Notifications\NewMessageNotification;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

class DefaultUser extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, MustVerifyEmail, Notifiable;

    protected $owner;
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {

        $this->notify(new ResetPasswordNotification($token, 'student'));
    }
    /**
     * Send a New Message notification to the user.
     *
     * @param  string  $title
     * @param  string  $body
     * @param  string  $actoin
     * @param  string  $icon
     * @return void
     */
    public function NewMessageNotification($title, $body, $sender_type, $sender, $action, $icon = '')
    {

        $this->notify(new NewMessageNotification($title, $body, $sender_type, $sender, $action, $icon));
    }

    
}
