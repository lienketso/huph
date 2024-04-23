<?php

namespace Post\Http\Controllers;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Support\Facades\Request;
use Post\Models\Post;
use Post\Repositories\PostRepository;

class CommentController extends BaseController
{
    protected $model;
    public function __construct(PostRepository $postRepository)
    {
        $this->model = $postRepository;
    }

    public function getIndex(Request $request){
        $q = Post::query();
        $q->where('post_type','comment');
        $data = $q->orderBy('created_at','desc')->paginate(20);
        return view('wadmin-post::comment.index',compact('data'));
    }
    public function getCreate(){
        return view('wadmin-post::comment.create');
    }

}
