<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'MatKhau' => [
                'bail',
                'required',
                'min:4',
                'required_with:XacMinhMatKhau',
                'same:XacMinhMatKhau',
            ],
            'XacMinhMatKhau' => [
                'bail',
                'required',
                'min:4',
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'MatKhau.required' => ':attribute bắt buộc phải nhập',
            'MatKhau.min' => ':attribute phải dài hơn 4 ký tự',
            'MatKhau.required_with' => ':attribute phải giống Xác Minh Mật Khẩu',
            'MatKhau.same' => ':attribute phải giống Xác Minh Mật Khẩu',
            'XacMinhMatKhau.required' => ':attribute bắt buộc phải nhập',
            'XacMinhMatKhau.min' => ':attribute phải dài hơn 4 ký tự',
        ];
    }

    public function attributes(): array
    {
        return [
            'MatKhau' => 'Mật khẩu mới',
            'XacMinhMatkhau' => 'Xác minh mật khẩu mới',
        ];
    }
}
