<?php


namespace Category\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Post\Models\Post;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['name','slug','parent','description','thumbnail','sort_order','lang_code','status','meta_title','meta_desc','display',
        'type',
        'filter',
        'cat_type',
        'banner',
        'banner_1',
        'banner_2',
        'banner_3',
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value,'-','');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent', 'id')->orderBy('sort_order','asc');
    }

    public function parents(){
        return $this->hasOne(Category::class,'id','parent');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
    }

    public function postCat(){
        return $this->hasMany(Post::class,'category')
            ->orderBy('created_at','desc')
            ->where('status','active')->where('is_home',1)->limit(5);
    }
    public function postHot(){
        return $this->hasMany(Post::class,'category')
            ->orderBy('created_at','desc')
            ->where('status','active')->where('is_hot',1)->limit(1);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category');
    }



}
