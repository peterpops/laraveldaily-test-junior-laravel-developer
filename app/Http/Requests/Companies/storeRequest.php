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
            'name' => [
                ['required'],
                ['string']
            ],
            'email' => [
                ['required'],
                ['email', ['rfc','dns']],
            ], 
            'website' => [
                ['required'],
                ['url'],
            ],
            'logo' => [
                ['nullable'],
                ['image'],
            ],
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Firstname is required',
            'name.string' => 'Must be a string',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email adress',
        ];
    }
}
