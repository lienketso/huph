<?php


namespace Post\Models;


use App\User;
use Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Users\Models\Users;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['name','slug','address','price_value','end_date','description','content','thumbnail','banner','file_attach','meta_desc','meta_title','meta_keyword','display','is_slider','is_hot','is_home','count_view','tags','user_post'
    ,'user_edit','status','post_type','lang_code','created_at','cat_tags'];


    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value,'-','');
    }
    public function setCat_tagAttribute($value)
    {
        $this->attributes['cat_tags'] = str_slug($value,'-','');
    }
    public function getUserPost(){
        return $this->belongsTo(Users::class,'user_post','id');
    }

    public function getUserEdit(){
        return $this->belongsTo(Users::class,'user_edit','id');
    }

    public function categorys(){
        return $this->belongsTo(Category::class,'category','id');
    }

    public function getCategory()
    {
        $cat = $this->categorys()->first();
        if (!empty($cat)) {
            return $cat->name;
        } else {
            echo '<span style="color:#c00">Chưa chọn danh mục</span>';
        }
    }

    public function user(){
        return $this->belongsTo(User::class,'user_post');
    }

    public function meta() {
        return $this->hasMany(PostMeta::class, 'post_id','id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }

}
