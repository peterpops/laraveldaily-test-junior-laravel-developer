<?php

namespace App\Http\Requests\Companies;

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
            'editForm.name' => [
                ['required'],
                ['string']
            ],
            'editForm.email' => [
                ['required'],
                ['email', ['rfc','dns']],
            ], 
            'editForm.website' => [
                ['required'],
                ['url'],
            ],
            'editForm.logo' => [
                ['nullable'],
                ['image'],
            ],
        ];
    }
}
