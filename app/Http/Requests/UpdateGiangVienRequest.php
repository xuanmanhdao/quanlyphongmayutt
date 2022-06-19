<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGiangVienRequest extends FormRequest
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
            'HoTen' => [
                'bail', // khi gặp lỗi sẽ báo về luôn
                'required',
                'max:50',
            ],
            'Email' => [
                'bail',
                'required',
                'email:rfc,dns',
                'max:50',

            ],
            'SDT' => [
                'bail',
                'required',
                'numeric',
                'starts_with:0',
                // 'min:10',
                // 'max:10',
                'digits:10',
            ],
            'GioiTinh' => [
                'required'
            ]
        ];
    }
    public function messages(): array
    {
        return [
            'unique' => ':attribute đã tồn tại',
            'required' => ':attribute bắt buộc phải nhập',
            'string' => ':attribute phải là kiểu chữ',
            'max' => ':attribute quá dài',
            'regex' => ':attribute không đúng định dạng',
            'min' => ':attribute quá ngắn',

            'numeric'=>':attribute phải là định dạng số',
            'starts_with'=>':attribute bắt đầu bằng số 0',

            'HoTen.max'=>':attribute tối đa 50 ký tự',

            'Email.email'=>':attribute không đúng định dạng',
            'Email.max'=>':attribute tối đa 50 ký tự',

            'SDT.max'=>':attribute phải là 10 ký tự 2',
            'SDT.min'=>':attribute phải là 10 ký tự 1',
            'SDT.digits'=>':attribute phải là 10 ký tự',

        ];
    }

    public function attributes(): array
    {
        return [
            'HoTen' => 'Họ tên',
            'Email' => 'Email',
            'SDT' => 'Số điện thoại',
            'GioiTinh' => 'Giới tính'
        ];
    }
}
