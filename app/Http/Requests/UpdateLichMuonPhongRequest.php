<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLichMuonPhongRequest extends FormRequest
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
            'NgayMuon' => [
                'bail', // khi gặp lỗi sẽ báo về luôn
                'required',
            ],
            'TietHoc' => [
                'bail', // khi gặp lỗi sẽ báo về luôn
                'required',
            ],
            'MaPhong' => [
                'required'
            ]
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'string' => ':attribute phải là kiểu chữ'
        ];
    }

    public function attributes(): array
    {
        return [
            'TietHoc' => 'Tiết học',
            'NgayMuon' => 'Ngày mượn',
            'MaPhong' => 'Mã phòng'
        ];
    }
}
