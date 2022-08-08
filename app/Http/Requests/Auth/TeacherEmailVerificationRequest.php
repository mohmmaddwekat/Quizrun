<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TeacherEmailVerificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       
        if (!hash_equals(
            (string) $this->route('id'),
            (string) $this->user('teacher')->getKey()
            )) {
            return false;
        }
        if (!hash_equals(
            (string) $this->route('hash'),
            sha1($this->user('teacher')->getEmailForVerification())
        )) {
            return false;
        }

        return true;
    }

    /**
     * Fulfill the email verification request.
     *
     * @return void
     */
    public function fulfill()
    {
        if (!$this->user('teacher')->hasVerifiedEmail()) {
            $this->user('teacher')->markEmailAsVerified();
            event(new Verified($this->user()));
        }
    }
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        return $validator;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
