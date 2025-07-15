<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRatingRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $ratingId = $this->route('rating');
        return [
            'name'=>['required', Rule::unique('ratings', 'name')->ignore($ratingId), 'min:3', 'max:32'],
            'icon'=>['required'],
            'value'=>['required', 'min:1', 'max:10']
        ];
    }
}
