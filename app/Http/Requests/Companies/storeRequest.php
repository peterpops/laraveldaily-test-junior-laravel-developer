<?php

namespace App\Http\Requests\Companies;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(User $user)
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
            'addForm.name' => [
                ['required'],
                ['string']
            ],
            'addForm.email' => [
                ['required'],
                ['email', ['rfc','dns']],
            ], 
            'addForm.website' => [
                ['required'],
                ['url'],
            ],
            'addForm.logo' => [
                ['nullable'],
                ['image'],
            ],
        ];
    }


    public function messages()
    {
        return [
            'addForm.name.required' => 'Firstname is required',
            'addForm.name.string' => 'Must be a string',
            'addForm.email.required' => 'Email is required',
            'addForm.email.email' => 'Invalid email adress',
        ];
    }
}
