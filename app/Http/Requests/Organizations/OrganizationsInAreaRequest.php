<?php

namespace App\Http\Requests\Organizations;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationsInAreaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'latitude'  => 'numeric',
            'longitude' => 'numeric',
            'radius'    => 'nullable|numeric',
        ];
    }
}
