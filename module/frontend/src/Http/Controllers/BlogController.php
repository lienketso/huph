<?php


namespace Frontend\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Category\Models\CategoryMeta;
use Category\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Post\Models\Post;
use Post\Models\PostMeta;
use Post\Repositories\PostRepository;
use Product\Models\Factory;

class BlogController extends BaseController
{
    protected $model;
    protected $cat;
    protected $lang;
    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->model = $postRepository;
        $this->cat = $categoryRepository;
        $this->lang = session('lang');
    }

    public function page($slug){
        $data = $this->model->getSinglePost($slug);

        //cấu hình các thẻ meta
        $meta_title = $data->meta_title;
        $meta_desc = cut_string($data->meta_desc,190);
        $meta_url = route('frontend::page.index.get',$data->slug);
        if($data->thumbnail!=''){
            $meta_thumbnail = upload_url($data->thumbnail);
        }else{
            $meta_thumbnail = public_url('admin/themes/images/no-image.png');
        }
        view()->composer('frontend:*', function($view) use ($meta_title,$meta_desc,$meta_url,$meta_thumbnail){
            $view->with(['meta_title'=>$meta_title,'meta_desc'=>$meta_desc,'meta_url'=>$meta_url,'meta_thumbnail'=>$meta_thumbnail]);
        });
        //end cấu hình thẻ meta
        $historyList = Factory::orderBy('sort_order','asc')->where('status','active')->where('lang_code',$this->lang)->get();

        //update count view
        $input['count_view'] = $data->count_view+1;
        $this->model->update($input,$data->id);
        //end update count view

        $related = $this->model->scopeQuery(function ($e) use ($data){
            return $e->orderBy('created_at','desc')
                ->where('post_type','page')
                ->where('status','active')
                ->where('lang_code',$this->lang)
                ->where('id','!=',$data->id);
        })->limit(6);

        return view('frontend::blog.page',[
            'data'=>$data,
            'related'=>$related,
            'historyList'=>$historyList
        ]);
    }

    public function latestPost(){
        $q = Post::query();
        $post = $q->orderBy('created_at','desc')
        ->where('display',1)
        ->where('post_type','blog')
        ->where('status','active')
        ->where('lang_code',$this->lang)
        ->paginate(20);
        return view('frontend::blog.new-post',compact('post'));
    }

    public function video(){
        $q = Post::query();
        $post = $q->orderBy('created_at','desc')
        ->where('post_type','video')
        ->where('status','active')
        ->paginate(18);
        return view('frontend::blog.video',compact('post'));
    }

    public function singlevideo($slug){
        $data = $this->model->findWhere(['post_type'=>'video','slug'=>$slug])->first();
        if(empty($data)){
            redirect();
        }
        $related = $this->model->scopeQuery(function ($e) use ($data){
            return $e->orderBy('created_at','desc')
                ->where('id','!=',$data->id)->where('post_type','video')->where('status','active');
        })->limit(6);
        return view('frontend::blog.templates.single-video',compact('data','related'));
    }

    public function index($slug, Request $request){
        $data = $this->cat->with(['childs'])->findWhere(['slug'=>$slug])->first();
        if($data) {
            $postQuery = $data->posts()->where('status','active');
            // Kiểm tra nếu tồn tại từ khóa tìm kiếm
            if (!empty($request->search)) {
                $search = $request->search;
                $postQuery->where(function($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%')
                        ->orWhere('content', 'like', '%'.$search.'%');
                });
            }
            $post = $postQuery->paginate(16);
        } else {
            return response()->json([
                'error' => 'Category not found'
            ], 404);
        }
        //cấu hình các thẻ meta
        $meta_title = $data->meta_title;
        $meta_desc = cut_string($data->meta_desc,190);
        $meta_url = route('frontend::blog.index.get',$data->slug);
        if($data->thumbnail!=''){
            $meta_thumbnail = upload_url($data->thumbnail);
        }else{
            $meta_thumbnail = public_url('admin/themes/images/no-image.png');
        }

        view()->composer('frontend:*', function($view) use ($meta_title,$meta_desc,$meta_url,$meta_thumbnail){
            $view->with(['meta_title'=>$meta_title,'meta_desc'=>$meta_desc,'meta_url'=>$meta_url,'meta_thumbnail'=>$meta_thumbnail]);
        });
        //end cấu hình thẻ meta

        //tin host
        $hotBlogCategory = $data->posts()->where('status','active')->where('is_hot',1)->first();


        return view('frontend::blog.index',[
            'data'=>$data,
            'post'=>$post,
            'hotBlogCategory'=>$hotBlogCategory
        ]);
    }

    public function loadMoreData(Request $request){
        $start = $request->input('start');
        $category = $request->input('category');
        $infoCategory = $this->cat->find($category);
        if($infoCategory){
            $data = $infoCategory->posts()->offset($start)->limit(1)->get();
            return response()->json([
                'data' => $data,
                'next' => $start + 4
            ]);
        } else {
            return response()->json([
                'error' => 'Category not found'
            ], 404);
        }
    }

    public function detail($slug){
        $data = $this->model->getSinglePost($slug);

        //bài viết liên quan

        $related = $this->model->scopeQuery(function ($e) use ($data){
            return $e->orderBy('created_at','desc')
                ->where('id','!=',$data->id)
                ->where('post_type','blog')
                ->where('slug','LIKE','%'.$data->slug.'%');
        })->limit(6);
        //category
        $listCat = $this->cat->orderBy('sort_order','asc')
            ->findWhere(['lang_code'=>$this->lang,'status'=>'active','parent'=>0])->all();
        //meta box
        $metaPost = PostMeta::where('post_id',$data->id)->get();
        //cấu hình các thẻ meta
        $meta_title = $data->meta_title;
        $meta_desc = cut_string($data->meta_desc,190);
        $meta_url = route('frontend::blog.index.get',$data->slug);
        if($data->thumbnail!=''){
            $meta_thumbnail = upload_url($data->thumbnail);
        }else{
            $meta_thumbnail = public_url('admin/themes/images/no-image.png');
        }
        view()->composer('frontend:*', function($view) use ($meta_title,$meta_desc,$meta_url,$meta_thumbnail){
            $view->with(['meta_title'=>$meta_title,'meta_desc'=>$meta_desc,'meta_url'=>$meta_url,'meta_thumbnail'=>$meta_thumbnail]);
        });
        //end cấu hình thẻ meta

        //update count view
        $input['count_view'] = $data->count_view+1;
        $this->model->update($input,$data->id);
        //end update count view

        $prevPost = Post::where('id','<',$data->id)
            ->where('lang_code',$this->lang)
            ->where('post_type','blog')
            ->where('category',$data->category)->first();
        $nextPost = Post::where('id','>',$data->id)
            ->where('lang_code',$this->lang)
            ->where('post_type','blog')
            ->where('category',$data->category)->first();


        return view('frontend::blog.detail',[
            'data'=>$data,
            'metaPost'=>$metaPost,
            'related'=>$related,
            'listCat'=>$listCat,
            'prevPost'=>$prevPost,
            'nextPost'=>$nextPost
        ]);
    }


    function search(Request $request){
        $name = $request->get('s');
        $q = Post::query();

        if (!is_null($name))
        {
            $q = $q->where('name','LIKE', '%'.$name.'%');
        }

        $data = $q->orderBy('created_at','desc')
            ->where('lang_code',$this->lang)
            ->where('status','active')->paginate(15);

        return view('frontend::blog.search',[
            'name'=>$name,
            'data'=>$data
        ]);
    }


}
