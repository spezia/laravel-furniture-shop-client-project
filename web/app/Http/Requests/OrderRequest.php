<?php

namespace App\Http\Requests;

use App\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'quantity.*' => 'required|integer',
            'total-price' => 'required',
            'first-name' => 'required',
            'last-name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
            'paying-method' => 'required|in:' . Order::TRANSACTION_PAYPAL . ',' . Order::TRANSACTION_BANK,
            'paypal-username' => 'required_if:paying-method,' . Order::TRANSACTION_PAYPAL,
            'paypal-email' => 'required_if:paying-method,' . Order::TRANSACTION_PAYPAL,
            'card-first-name' => 'required_if:paying-method,' . Order::TRANSACTION_BANK,
            'card-last-name' => 'required_if:paying-method,' . Order::TRANSACTION_BANK,
            'card-number' => 'required_if:paying-method,' . Order::TRANSACTION_BANK,
            'card-date' => 'required_if:paying-method,' . Order::TRANSACTION_BANK,
            'card-security-code' => 'required_if:paying-method,' . Order::TRANSACTION_BANK,
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'total-price.required' => trans('Total price is invalid.'),
            'first-name.required' => trans('First name is required.'),
            'last-name.required' => trans('Last name is required.'),
            'email.required' => trans('Email is required.'),
            'email.email' => trans('Email is invalid.'),
            'address.required' => trans('Address is required.'),
            'phone.required' => trans('Phone is required.'),
            'paying-method.required' => trans('Paying method is required.'),
            'paying-method.in' => trans('Paying method is invalid.'),
            'paypal-username.required_if' => trans('Paypal username is required.'),
            'paypal-email.required_if' => trans('Paypal email is required.'),
            'paypal-email.email' => trans('Paypal email is not valid.'),
            'card-first-name.required_if' => trans('Bank card first name is required.'),
            'card-last-name.required_if' => trans('Bank card last name is required.'),
            'card-number.required_if' => trans('Bank card number is required.'),
            'card-security-code.required_if' => trans('Bank card security code is required.'),
            'card-date.required_if' => trans('Bank card date is required.'),
        ];
    }
}
