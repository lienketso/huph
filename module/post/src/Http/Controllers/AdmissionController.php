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
class AdmissionController extends BaseController
{
    protected $model;
    protected $cat;
    protected $langcode;
    protected $set;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->model = $postRepository;
        $this->cat = $categoryRepository;
        $this->langcode = session('lang');
    }

    //sản phẩm
    public function getIndexProduct(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');
        $category_id = $request->get('category');
        $user_post = $request->get('user_post');
        $q = Post::query();
        if($id){
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
            ->where('post_type','tuyensinh')
            ->orderBy('id','desc')->paginate(20);
        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        $category = $this->cat->orderBy('created_at','desc')
            ->findWhere(['lang_code'=>$this->langcode,'cat_type'=>'tuyensinh','parent'=>0])->all();
        $userPost = Users::where('status','active')->get();
        return view('wadmin-post::product.index',compact('data','permissionPost','category','userPost'));
    }

    public function getCreateProduct(){
        $categories = $this->cat->orderBy('created_at','desc')
            ->where('lang_code',$this->langcode)->where('cat_type','tuyensinh')->get();

        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        return view('wadmin-post::product.create',['categories'=>$categories,'permissionPost'=>$permissionPost]);
    }
    public function postCreateProduct(Request $request){

        try{
            $input = $request->except(['_token','continue_post']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['banner'] = replace_thumbnail($input['banner']);
            if($request->slug=='' || is_null($request->slug)){
                $input['slug'] = $request->name;
            }
            $input['user_post'] = Auth::id();
            $input['lang_code'] = $this->langcode;
            $input['post_type'] = 'tuyensinh';
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            //create TS data
            $category = $request->category;
            if(!is_null($request->post_id) || $request->post_id!=''){
                $data = Post::updateOrCreate(
                    ['id' => $request->post_id],$input
                );
            }else{
                $data = $this->model->create($input);
            }
//            $data = $this->model->create($input);
            $this->model->sync($data->id,'categories',$category);

            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::tuyen-sinh.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::tuyen-sinh.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    function getEditProduct($id){
        $data = $this->model->find($id);
        $category = $this->cat->orderBy('created_at','desc')
            ->findWhere(['lang_code'=>$this->langcode,'cat_type'=>'tuyensinh','parent'=>0])->all();
        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        $currentCategory = $data->categories()->get()->toArray();
        $args = [];
        foreach ($currentCategory as $perm) {
            $args[] = $perm['id'];
        }
        return view('wadmin-post::product.edit',['data'=>$data,'category'=>$category,'permissionPost'=>$permissionPost,'currentCategories'=>$args]);
    }

    function postEditProduct($id, PostEditRequest $request){
        try{
            $input = $request->except(['_token']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['banner'] = replace_thumbnail($input['banner']);
            $input['post_type'] = 'tuyensinh';
            if($request->slug=='' || is_null($request->slug)){
                $input['slug'] = $request->name;
            }
            $input['user_edit'] = Auth::id();
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $category = $request->input('category');
            $update = $this->model->update($input, $id);
            $this->model->sync($update->id,'categories',$category);
            return redirect()->route('wadmin::tuyen-sinh.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    public function cloneProduct($id){
        $post = Post::find($id);
        $newPost = $post->replicate();
        $newPost->created_at = Carbon::now();
        $newPost->name = $post->name.' Copy';
        $newPost->slug = $post->slug.'-copy';
        $newPost->status = 'disable';
        $newPost->count_view = 0;
        $newPost->save();
        return redirect()->route('wadmin::tuyen-sinh.index.get')
            ->with('create','Nhân bản sản phẩm thành công');
    }

    function removeTuyensinh($id){
        try{
            $post = Post::find($id);
            $post->meta()->delete();
            $this->model->delete($id);
            return redirect()->back()->with('delete','Bạn vừa xóa dữ liệu !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

}
