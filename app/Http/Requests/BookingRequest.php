<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'status' => 'required|in:pending,approved,rejected',
            'payment_method' => 'required|in:credit_card,debit_card,paypal,midtrans',
            'payment_status' => 'required|in:paid,unpaid',
            'payment_url' => 'nullable|url',
            'total_price' => 'required|numeric|min:0',
            'item_id' => 'required|exists:items,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
