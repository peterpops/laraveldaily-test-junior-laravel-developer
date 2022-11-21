<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
            'editForm.firstName' => [
                ['required'],
            ],
            'editForm.lastName' => [
                ['required'],
            ],
            'editForm.email' => [
                ['required'],
                ['email', ['rfc','dns']],
            ],
            'editForm.phone' => [
                ['required'],
            ], 
            'editForm.company' => [
                ['required'],
                ['integer'],
            ],
        ];
    }

    public function messages()
    {
        return [
            'editForm.firstName.required' => 'Firstname is required',
            'editForm.lastName.required' => 'Lastname is required',
            'editForm.email.required' => 'An email is required',
            'editForm.email.email' => 'Must be a valid email address',
            'editForm.phone.required' => 'A phonenumber is required',
        ];
    }
}
