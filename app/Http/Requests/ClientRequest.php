<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => ' اسم العميل مطلوب',
         //   'name.string' => 'اسم العميل لابد ان يكون احرف',
            'phone.required'=>'الهاتف مطلوب',
            'address.required'=>'العنوان مطلوب'
        ];
    }
}
