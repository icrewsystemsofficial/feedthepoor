<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VolunteerFormRequest extends FormRequest
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
            'name' => ['required'],
            'age' => ['required'],
            'email' => ['required','email'],
            'number' => ['required'],
            'organization' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'address' => ['required'],
            'pincode' => ['required'],
            'experience' => ['required'],
            'education' => ['required'],
            'reason' => ['required'],
            'facebook' => ['nullable'],
            'instagram' => ['nullable'],
            'twitter' => ['nullable']


        ];
    }
}
