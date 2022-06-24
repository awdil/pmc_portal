<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeamRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:32',
            'description' => 'nullable|min:2|max:128',
            'display_name' => 'nullable|min:2|max:32',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Team name required.',
            'name.min' => 'Team name needs to min. 2',
            'name.max' => 'Team name can max be. 32',
            'description.min' => 'Description needs to min. 2',
            'description.max' => 'Description name can max be. 128',
            'display_name.min' => 'Display name needs to min. 2',
            'display_name.max' => 'Display name can max be. 32',
        ];
    }
}
