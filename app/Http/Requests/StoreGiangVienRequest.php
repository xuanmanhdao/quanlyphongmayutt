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
                'unique:giangvien',
                'email:rfc,dns',
                'max:50',

            ],
            'SDT' => [
                'bail',
                'required',
                'numeric',
                'unique:giangvien',
                'starts_with:0',
                // 'min:10',
                // 'max:10',
                'digits:10',
                // 'regex:/^([0-9\s\-\+\(\)]*)$/',
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
            // 'regex' => ':attribute bắt đầu bằng số 0',
            'numeric'=>':attribute phải là định dạng số',
            'starts_with'=>':attribute bắt đầu bằng số 0',

            'MaGiangVien.max'=>':attribute tối đa 20 ký tự',

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
            'MaGiangVien' => 'Mã giảng viên',
            'HoTen' => 'Họ tên',
            'Email' => 'Email',
            'SDT' => 'Số điện thoại',
            'GioiTinh' => 'Giới tính'
        ];
    }
}
