<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:100',
            'address' => 'required|string|min:3|max:100',
            'description' => 'string|min:1',
            'contact' => 'required|string|min:3|max:100',
            'instagram' => 'required|string|min:3|max:100',
            'linkedin' => 'required|string|min:3|max:100',
            'youtube' => 'required|string|min:3|max:100',
        ];
    }
}
