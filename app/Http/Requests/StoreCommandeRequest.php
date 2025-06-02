<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommandeRequest extends FormRequest
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
            'boutique_id' => ['required', 'integer'],
            'total' => ['required', 'numeric'],
            'status' => ['nullable', 'string', 'in:paid,pending,cancelled,shipped'],
            'payment' => ['required', 'string', 'in:mastercard,visa,unionpay'],
            'niu' => ['required', 'string', 'regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/'],
            'cvv' => ['required', 'string', 'max:3', 'min:3'],
            'exp' => ['required', 'string', 'max:5', 'min:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'boutique_id.required' => 'Le champ boutique_id est obligatoire.',
            'boutique_id.integer' => 'Le champ boutique_id doit être un entier.',

            'total.required' => 'Le total est obligatoire.',
            'total.numeric' => 'Le total doit être un nombre.',

            'status.in' => 'Le statut doit être l\'une des valeurs suivantes : paid, pending, cancelled ou shipped.',
            'status.string' => 'Le statut doit être une chaîne de caractères.',

            'payment.required' => 'Le mode de paiement est obligatoire.',
            'payment.string' => 'Le mode de paiement doit être une chaîne de caractères.',
            'payment.in' => 'Le mode de paiement doit être mastercard, visa ou unionpay.',

            'niu.required' => 'Le champ NIU est obligatoire.',
            'niu.string' => 'Le NIU doit être une chaîne de caractères.',
            'niu.regex' => 'Le format du NIU est invalide. Utilisez le format 1234-5678-9012-3456.',

            'cvv.required' => 'Le champ CVV est obligatoire.',
            'cvv.string' => 'Le CVV doit être une chaîne de caractères.',
            'cvv.max' => 'Le CVV doit contenir exactement 3 chiffres.',
            'cvv.min' => 'Le CVV doit contenir exactement 3 chiffres.',

            'exp.required' => 'Le champ expiration est obligatoire.',
            'exp.string' => 'Le champ expiration doit être une chaîne de caractères.',
            'exp.max' => 'Le champ expiration doit contenir exactement 5 caractères (format MM/AA).',
            'exp.min' => 'Le champ expiration doit contenir exactement 5 caractères (format MM/AA).',
        ];
    }
}
