<?php

namespace App\Http\Requests\Auth;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'userType' => 'required|in::userType,alumni,teacher,student',
                'batch' => 'required_if:userType,==,alumni|required_if:userType,==,student|string',
                'password'  =>  'required|min:6',
                'confirmationPassword'  =>  'required|same:password',
            ];
    }
}
