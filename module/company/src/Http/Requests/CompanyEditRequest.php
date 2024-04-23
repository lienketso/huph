<?php


namespace Company\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CompanyEditRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required',
            'cat_id'=>'required'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tên công ty',
            'cat_id.required'=>'Bạn chưa chọn danh mục ngành nghề',
        ];
    }
}
