<?php


namespace Post\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Category\Models\CategoryMeta;
use Category\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Post\Http\Requests\PostCreateRequest;
use Post\Http\Requests\PostEditRequest;
use Post\Models\Post;
use Post\Models\PostMeta;
use Post\Repositories\PostRepository;
use Product\Repositories\FactoryRepository;
use Setting\Repositories\SettingRepositories;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Users\Models\Users;
use Illuminate\Support\Carbon;

class PostsController extends BaseController
{
    protected $model;
    protected $cat;
    protected $langcode;
    protected $set;
    protected $fac;
    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository, SettingRepositories  $settingRepositories, FactoryRepository $factoryRepository)
    {
        $this->model = $postRepository;
        $this->cat = $categoryRepository;
        $this->set = $settingRepositories;
        $this->fac = $factoryRepository;
        $this->langcode = session('lang');
    }

    public function getIndex(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');
        $category_id = $request->get('category');
        $user_post = $request->get('user_post');
        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        $q = Post::query();

        if(!is_null($id)){
            $q->where('id',$id);
        }
        if(!is_null($name)){
            $q->where('name','LIKE','%'.$name.'%');
        }
        if(!is_null($category_id)){
            $q->where('category',$category_id);
        }
        if(!is_null($user_post)){
            $q->where('user_post',$user_post);
        }
        $data = $q->where('lang_code',$this->langcode)
            ->where('post_type','blog')
            ->orderBy('created_at','desc')
            ->paginate(20);

        $category = $this->cat->orderBy('created_at','desc')
            ->findWhere(['lang_code'=>$this->langcode,'type'=>'blog'])->all();
        $userPost = Users::where('status','active')->get();
        return view('wadmin-post::index',['data'=>$data,'permissionPost'=>$permissionPost,'category'=>$category,'userPost'=>$userPost]);
    }
    public function getCreate(){
        $userLog = Auth::user();
        $data = new Post();
        $postModel = $this->model;
        $roles = $userLog->load('roles.perms');
        $setting = $this->set;
        $permissionPost = $roles->roles->first()->perms;
        $lang = $this->langcode;
        $catMeta = CategoryMeta::all();
        $factory = $this->fac->orderBy('sort_order','asc')->findWhere(['status'=>'active','lang_code'=>$this->langcode])->all();
        $allCategory = $this->cat->orderBy('name','asc')
            ->findWhere(['parent'=>0,'lang_code'=>$this->langcode,'cat_type'=>'post'])->all();

        return view('wadmin-post::create',[
            'allCategory'=>$allCategory,
            'permissionPost'=>$permissionPost,
            'data'=>$data,
            'postModel'=>$postModel,
            'setting'=>$setting,
            'lang'=>$lang,
            'catMeta'=>$catMeta,
            'factory'=>$factory
        ]);
    }
    public function postCreate(PostCreateRequest $request){
        try{
            $input = $request->except(['_token','continue_post']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['file_attach'] = replace_thumbnail($input['file_attach']);
            $input['banner'] = replace_thumbnail($input['banner']);
            $input['post_type'] = 'blog';
            $input['slug'] = $request->name;
            $input['user_post'] = Auth::id();
            $input['lang_code'] = $this->langcode;
            $input['created_at'] = input_format_date($request->created_at);
            $category = $request->input('category');
            $input['cat_tags'] = convertToSlugWithDiacritics($input['tags']);
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $data = $this->model->create($input);
            $this->model->sync($data->id,'categories',$category);

            //set meta for post
//            if(!is_null($request->meta)){
//                $arr = [];
//                foreach($request->meta as $key=>$m){
//                    $arr += [$key=>json_encode($m,JSON_UNESCAPED_UNICODE)];
//                }
//                $this->model->setMeta($arr,$data->id);
//            }

            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::post.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::post.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEdit($id){
        $allCategory = $this->cat->orderBy('name','asc')->findWhere(['parent'=>0,'lang_code'=>$this->langcode,'cat_type'=>'post'])->all();
        $data = $this->model->find($id);
        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        $lang = $this->langcode;
        $setting = $this->set;
        $postModel = $this->model;
        $catMeta = CategoryMeta::all();
        $factory = $this->fac->orderBy('sort_order','asc')->findWhere(['status'=>'active','lang_code'=>$this->langcode])->all();

        $currentCategory = $data->categories()->get()->toArray();
        $args = [];
        foreach ($currentCategory as $perm) {
            $args[] = $perm['id'];
        }

        return view('wadmin-post::edit',[
            'data'=>$data,
            'allCategory'=>$allCategory,
            'permissionPost'=>$permissionPost,
            'postModel'=>$postModel,
            'setting'=>$setting,
            'lang'=>$lang,
            'catMeta'=>$catMeta,
            'factory'=>$factory,
            'currentCategories'=>$args
        ]);
    }

    function postEdit($id, PostEditRequest $request){
        try{
            $input = $request->except(['_token']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['file_attach'] = replace_thumbnail($input['file_attach']);
            $input['banner'] = replace_thumbnail($input['banner']);
            $input['post_type'] = 'blog';
            $input['slug'] = $request->name;
            $input['user_edit'] = Auth::id();

            $input['created_at'] = input_format_date($request->created_at);
            $input['cat_tags'] = convertToSlugWithDiacritics($input['tags']);
            // dd($input['created_at']);
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $category = $request->input('category');

            $update = $this->model->update($input, $id);
            if($update->user_post==0){
                $update->user_post = Auth::id();
                $update->save();
            }
            $this->model->sync($update->id,'categories',$category);

            //update meta for post
//            if(!is_null($request->meta)){
//                $arr = [];
//                foreach($request->meta as $key=>$m){
//                    $arr += [$key=>json_encode($m,JSON_UNESCAPED_UNICODE)];
//                }
//                $this->model->updateMeta($arr,$id);
//            }

            return redirect()->route('wadmin::post.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }


    public function ClonePost($id){
        $post = Post::find($id);
        $newPost = $post->replicate();
        $newPost->created_at = Carbon::now();
        $newPost->name = $post->name.' Copy';
        $newPost->slug = $post->slug.'-copy';
        $newPost->status = 'disable';
        $newPost->count_view = 0;
        $newPost->save();
        return redirect()->route('wadmin::post.index.get')
            ->with('create','Nhân bản bài viết thành công');
    }


    function remove($id){
        try{
            $post = Post::find($id);
            $post->meta()->delete();
            $this->model->delete($id);
            return redirect()->back()->with('delete','Bạn vừa xóa dữ liệu !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    public function changeStatus($id){
        $input = [];
        $data = $this->model->find($id);
        if($data->status=='active'){
            $input['status'] = 'disable';
        }elseif ($data->status=='disable'){
            $input['status'] = 'active';
        }
        $this->model->update($input,$id);
        return redirect()->back();
    }




}
