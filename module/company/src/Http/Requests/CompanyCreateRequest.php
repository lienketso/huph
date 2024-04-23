<?php


namespace Company\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required|unique:company,name',
            'cat_id'=>'required'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tên công ty',
            'name.unique'=>'Tên công ty đã được đặt trước đó',
            'cat_id.required'=>'Bạn chưa chọn ngành nghề'
        ];
    }

}
