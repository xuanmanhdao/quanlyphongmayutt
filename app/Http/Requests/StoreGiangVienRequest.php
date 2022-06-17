<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGiangVienRequest extends FormRequest
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
            'MaGiangVien' => [
                'bail', // khi gặp lỗi sẽ báo về luôn
                'required',
                'unique:giangvien',
                'max:20',
            ],
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
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10',
                'max:20',
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
            'min' => ':attribute quá ngắn'
        ];
    }

    public function attributes(): array
    {
        return [
            'MaGiangVien' => 'Mã giảng viên',
            'HoTen' => 'Họ tên',
            'Email' => 'Email',
            'SDT' => 'Số điện thoại',
            'GioiTinh' => 'Giới tính'
        ];
    }
}
