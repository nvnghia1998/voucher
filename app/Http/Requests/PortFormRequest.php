<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortFormRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'category_id' =>['required', 'string'],
            'voucher_quantity' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return ['id.required' => 'Trường ID là bắt buộc'];
    }
}
