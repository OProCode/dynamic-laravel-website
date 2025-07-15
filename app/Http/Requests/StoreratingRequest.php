<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreratingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !is_null(auth()->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [

            'name' => [
                'required',
                'min:2',
                'max:32',
                Rule::unique('ratings', "name")->ignore($this->route('rating')),
            ],

            'icon'=>['required'],

            'value'=>['required', 'min: 1', 'max: 10'],
        ];
    }
}
