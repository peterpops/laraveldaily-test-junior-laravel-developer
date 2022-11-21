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
            'addForm.firstName' => [
                ['required'],
            ],
            'addForm.lastName' => [
                ['required'],
            ],
            'addForm.email' => [
                ['required'],
                ['email', ['rfc','dns']],
            ],
            'addForm.phone' => [
                ['required'],
            ], 
            'addForm.company' => [
                ['required'],
                ['integer'],
            ],
        ];
    }

    public function messages()
    {
        return [
            'addForm.firstName.required' => 'Firstname is required',
            'addForm.lastName.required' => 'Lastname is required',
            'addForm.email.required' => 'An email is required',
            'addForm.email.email' => 'Must be a valid email address',
            'addForm.phone.required' => 'A phonenumber is required',
        ];
    }
}
