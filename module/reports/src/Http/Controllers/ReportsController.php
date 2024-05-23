<?php

namespace Reports\Http\Controllers;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Support\Facades\Request;
use Post\Models\Post;
use Post\Repositories\PostRepository;
use Users\Models\Users;
use Users\Repositories\UsersRepository;

class ReportsController extends BaseController
{
    protected $po;
    protected $us;
    public function __construct(PostRepository $postRepository,UsersRepository $usersRepository){
        $this->po = $postRepository;
        $this->us = $usersRepository;
    }

    public function getIndex(Request $request){
        $q = Users::query();
        $data = $q->orderBy('created_at','desc')->paginate(20);
        return view('wadmin-reports::index',compact('data'));
    }

    public function getPost($id){
        $user = $this->us->find($id);
        $q = Post::query();
        $data = $q->where('user_post',$id)->paginate(20);
        return view('wadmin-reports::posts',compact('user','data'));
    }

}
