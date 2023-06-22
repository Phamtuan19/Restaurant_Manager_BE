<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SingUpRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->id, 'id'),
            ],
            'password' => 'required|min:6|',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là ký tự',
            'unique' => ':attribute đã tồn tại',
            'email' => ':attribute không đúng địng dạng',
            'string' => ':attribute không đúng địng dạng',
            'regex' => ':attribute không đúng định dạng',
            'max' => ':attribute không được quá :max ký tự',
            'min' => ':attribute phải lớn hơn :min ký tự',
            'confirmed' => ':attribute không trùng khớp',
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
            'password_confirmation' => 'Mật khẩu nhập lại',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([$validator->errors()], 200));
    }
}
