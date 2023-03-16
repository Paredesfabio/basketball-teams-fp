<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
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
            'country_id' => ['required'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'school' => ['required', 'string', 'max:100'],
            'number' => ['required', 'integer', 'min:0'],
            'position' => ['required','string'],
            'birth_date' => ['required','date'],
            'draft_date' => ['required','date'],
            'weight' => ['required', 'integer', 'min:0'],
            'height' => ['required', 'string'],
            'about_me' => ['required', 'string', 'max:1000'],
            'image' => 'mimes:jpeg,png,jpg|file|max:2048',
            'role' => ['required'],
            'team_id' => ['required'],
        ];
    }
}
