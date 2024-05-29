<?php

namespace Post\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Category\Models\CategoryMeta;
use Category\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Post\Models\Post;

class ApiPostController extends BaseController
{
    protected $model;
    public function __construct(Request $request, CategoryRepository $categoryRepository)
    {
        $this->model = $categoryRepository;
    }
    public function changeCategory(Request $request){
        $id = $request->get('id');
        $categoryMeta = CategoryMeta::where('category',$id)->first();
        if(!empty($categoryMeta)){
            $category = $categoryMeta->meta_value;
        }else{
            $category = '';
        }

        return $category;
    }

    public function saveDraft(Request $request)
    {
        $post = Post::updateOrCreate(
            ['id' => $request->post_id],
            [
                'name' => $request->title,
                'slug'=>$request->slug,
                'description' => $request->description,
                'content' => $request->contents,
                'post_type'=>$request->post_type,
                'user_post'=>Auth::id(),
                'status' => 'disable',
            ]
        );

        return response()->json(['success' => true, 'post_id' => $post->id,'newUrl'=>route('frontend::blog.detail.get',$post->slug)]);
    }

}
