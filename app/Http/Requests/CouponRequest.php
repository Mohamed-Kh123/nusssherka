<?php

namespace App\Http\Requests;

use App\Models\Coupon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(request()->routeIs('coupons.update')){
            $coupon = Coupon::find(request()->coupon);
            return [
                'name' => ['sometimes', 'required', 'max:255'],
                'code' => ['sometimes','required','max:255',Rule::unique('coupons')->ignore($coupon->id)],
                'limit' => ['sometimes','required','integer', 'min:-1'],
                'discount' => ['sometimes', 'required','integer', 'between:1,100'],
                'expire_date' => ['sometimes', 'required', 'date', 'after_or_equal:today'],
                'description' => ['nullable'],
            ];
        }
        return [
            'name' => ['required', 'max:255'],
            'code' => ['required', 'max:255', 'unique:coupons,code'],
            'limit' => ['required', 'integer', 'min:-1'],
            'discount' => ['required', 'integer', 'between:1,100'],
            'expire_date' => ['required', 'date', 'after_or_equal:today'],
            'description' => ['nullable'],
        ];
    }

    public function  messages()
    {
        return  [
            'limit.min' => 'The limit must be -1 or positive integer',
            'expire_date.after_or_equal' => 'The expire date field must be a date after or equal today.'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
