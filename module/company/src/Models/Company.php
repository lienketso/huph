<?php


namespace Company\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Product\Models\Catproduct;
use Users\Models\Users;

class Company extends Model
{
    protected $table = 'company';
    protected $fillable = ['name','slug','tax_name','moneyrule','operating_year','legal_type','city','address','phone','email','description','content','thumbnail',
        'meta_desc','meta_title','display','count_view','useradd','status','operating_status','lang_code'];


    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value,'-','');
    }

    public function getUserPost(){
        return $this->belongsTo(Users::class,'user_post','id');
    }

    //relation to perm
    public function category()
    {
        return $this->belongsToMany(Catproduct::class, 'catproduct_company','company_id','cat_id');
    }

    public function companyPivot(){
        return $this->belongsToMany(Catproduct::class,'catproduct_company','company_id')
            ->with('category')->withPivot(['company_id','cat_id']);
    }

    public function getallCattegory(){
        $allcat = $this->category()->get();
        if(!empty($allcat)){
            foreach($allcat as $row){
                echo '<span class="skill-tag">'.$row->name.'</span>';
            }
        }else{
            return '';
        }
    }

    public function getCategory()
    {
        $cat = $this->category()->first();
        if (!empty($cat)) {
            return $cat->name;
        } else {
            echo '<span style="color:#c00">Chưa chọn danh mục</span>';
        }
    }

}
