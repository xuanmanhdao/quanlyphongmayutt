<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhongRequest extends FormRequest
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
            'TenToaNha' => [
                'bail', // khi gặp lỗi sẽ báo về luôn
                'required',
            ],
            'TenPhong' => [
                'bail', // khi gặp lỗi sẽ báo về luôn
                'required',
                'numeric',
                'max:900',
                'min:100',
            ],
            'SoMay' => [
                'bail', // khi gặp lỗi sẽ báo về luôn
                'required',
                'numeric',
                'max:200',
                'min:0',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'numeric' => ':attribute phải là định dạng số',
            'max' => ':attribute đã quá số lượng cho phép',
            'min' => ':attribute số lượng quá ít',
            'unique' => ':attribute đã tồn tại',

        ];
    }

    public function attributes(): array
    {
        return [
            'TenPhong' => 'Tên phòng',
            'SoMay' => 'Số máy',
            'TenToaNha' => 'Tên tòa nhà',
        ];
    }
}
