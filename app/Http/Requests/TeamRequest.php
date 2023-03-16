<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'about' => ['required', 'string', 'max:1000'],
            'color' => ['required', 'string', 'max:10'],
            'image' => 'mimes:jpeg,png,jpg|file|max:2048',
            'division_id' => ['required'],
        ];
    }
}
