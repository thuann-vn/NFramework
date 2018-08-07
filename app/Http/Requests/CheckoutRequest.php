<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'email' => 'email',
            'name' => 'required_if:address_id,==,0',
            'address' => 'required_if:address_id,==,0',
            'city' => 'required_if:address_id,==,0',
            'province' => 'required_if:address_id,==,0',
            'phone' => 'required_if:address_id,==,0',
            'payment_method' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required_if' => __('frontend.checkout.validate.name'),
            'address.required_if' => __('frontend.checkout.validate.address'),
            'city.required_if' => __('frontend.checkout.validate.city'),
            'province.required_if' => __('frontend.checkout.validate.province'),
            'phone.required_if' => __('frontend.checkout.validate.phone'),
            'payment_method.required' => __('frontend.checkout.validate.payment_method'),
        ];
    }
}
