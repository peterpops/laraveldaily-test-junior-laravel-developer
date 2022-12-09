<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstName' => [
                ['required'],
            ],
            'lastName' => [
                ['required'],
            ],
            'email' => [
                ['required'],
                ['email', ['rfc','dns']],
            ],
            'phone' => [
                ['required'],
            ], 
            'company' => [
                ['required'],
                ['integer'],
            ],
        ];
    }

    public function messages()
    {
        return [
            'firstName.required' => 'Firstname is required',
            'lastName.required' => 'Lastname is required',
            'email.required' => 'An email is required',
            'email.email' => 'Must be a valid email address',
            'phone.required' => 'A phonenumber is required',
        ];
    }
}
