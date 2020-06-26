<?php

namespace App\Http\Requests\Auth;

use http\Env\Request;
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
                'userType' => 'required|in::student,alumni,teacher',
                'batch' => 'string',
                'password'  =>  'required|min:6',
                'confirmationPassword'  =>  'required|same:password',
            ];

    }

    protected function failedValidation(Validator $validator) {
       $request =  \Illuminate\Http\Request::all();
       $request["error"] =  $validator->errors();
        throw new HttpResponseException(response()->json($request, 422));
    }


}
