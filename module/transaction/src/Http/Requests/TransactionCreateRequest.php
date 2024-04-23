<?php


namespace Transaction\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class TransactionCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required',
            'email'=>'required|email',
            'nation'=>'required',
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập họ tên',
            'email.required'=>'Bạn chưa nhập email',
            'email.email'=>'Email không đúng định dạng',
            'nation.required'=>'Vui lòng nhập quốc gia'
        ];
    }
}
