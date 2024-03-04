<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5|max:255',
            'slug' => 'max:255|unique:categories,slug,' . $this->id . ',id',
            'des' => 'string|max:255',
        ];
    }

    public function attributes()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }
}
