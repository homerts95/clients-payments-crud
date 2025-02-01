<?php

namespace App\Http\Requests;

use App\Models\Client;
use App\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //since no auth
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            Payment::AMOUNT => [
                'required', 'numeric', 'decimal:0,2',
            ],
            Payment::CLIENT_ID => [
                'required', 'integer', 'exists:clients,id'
            ]
        ];
    }
}
