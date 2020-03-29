<?php

namespace App\Http\Requests;

use App\Rules\TagNameNotExists;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {

        return [
            'tags.*' => 'nullable|max:255',
            'custom_tags' => ['nullable', 'min:3', 'max:255'],
            'text' => ['required', 'max:255'],

        ];
    }
}
