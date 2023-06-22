<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SingInRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'unique' => ':attribute đã tồn tại',
            'email' => ':attribute không đúng địng dạng',
            'string' => ':attribute không đúng địng dạng',
            'max' => ':attribute không được quá :max ký tự',
            'min' => ':attribute phải lớn hơn :min ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Tài khoản đăng nhập',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'position_id' => 'Chức danh',
            'password' => 'Mật khẩu',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([$validator->errors()], 200));
    }
}
