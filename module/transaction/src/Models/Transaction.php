<?php


namespace Transaction\Models;


use Company\Models\Company;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = ['user_id','company_id','name','phone','address','email','company_info','nation','message','status'];

    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function getCompany(){
        $com = $this->company()->first();
        if (!empty($com)) {
            return $com->name;
        } else {
            echo '<span style="color:#c00">Null</span>';
        }
    }

}
