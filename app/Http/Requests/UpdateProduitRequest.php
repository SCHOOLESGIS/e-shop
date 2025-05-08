<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduitRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png,webp'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric', 'min:0'],
            'boutique_id' => ['required', 'exists:boutiques,id'],
            'categorie_id' => ['required', 'exists:categories,id'],
        ];
    }
}
