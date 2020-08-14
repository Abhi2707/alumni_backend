<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'userId' => 'required|exists:users,id',
            'gender' => 'required|string',
            'coverImageUrl' => 'string',
            'coverImageId' => 'integer',
            'profileImageId' => 'integer',
            'profileImageUrl' => 'string',
            'currentWorkStatus' => 'array',
            'dateOfBirth' => 'required|date_format:Y-m-d',
            'phoneNumber1' => 'required|array',
            'phoneNumber2' => 'array',
            'joinedInYear' => 'required|date_format:Y-m-d',
            'leftInYear' => 'date_format:Y-m-d',
        ];
    }
}
