<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductInsert extends FormRequest
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
            'name.*' => 'required',
            'description.*' => 'required',
            'properties.*' => 'required',
            'price' => 'required',
            'code' => 'required',
            'category' => 'required',
            'is_enabled' => 'boolean',
            'images.*' => 'required|image|max:2048', // size 2 MB
        ];
    }
}
