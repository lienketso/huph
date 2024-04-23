<?php


namespace Category\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Category\Http\Requests\CategoryCreateRequest;
use Category\Http\Requests\CategoryEditRequest;
use Category\Models\Category;
use Category\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $model;
    protected $langcode;
    public function __construct(CategoryRepository $categoryRepository)
    {
       $this->model = $categoryRepository;
       $this->langcode = session('lang');
    }

    public function getIndex(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');
        $q = Category::query();

        if($id){
            $q->where('id',$id);
        }
        if($name){
            $q->where('name','LIKE','%'.$name.'%');
        }
        $data = $q->orderBy('created_at','desc')
            ->where('lang_code',$this->langcode)
            ->where('cat_type','post')
            ->paginate(15);
        $model = $this->model;
        return view('wadmin-category::index',['data'=>$data,'model'=>$model]);
    }
    public function getCreate(){
       // $categories = $this->model->optionCategory(0,1,4,0,0);
        $model = $this->model;
        return view('wadmin-category::create',['model'=>$model]);
    }
    public function postCreate(CategoryCreateRequest $request){
        try{
            $input = $request->except(['_token','continue_post']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['banner'] = replace_thumbnail($input['banner']);
            $input['banner_1'] = replace_thumbnail($input['banner_1']);
            $input['banner_2'] = replace_thumbnail($input['banner_2']);
            $input['banner_3'] = replace_thumbnail($input['banner_3']);
            $input['lang_code'] = $this->langcode;
            //cấu hình seo
            $input['slug'] = $request->name;
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $data = $this->model->create($input);

            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::category.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::category.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEdit($id){
        $data = $this->model->find($id);
        $model = $this->model;
        return view('wadmin-category::edit',['data'=>$data,'model'=>$model]);
    }

    function postEdit($id, CategoryEditRequest $request){
        try{
            $input = $request->except(['_token']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['banner'] = replace_thumbnail($input['banner']);
            $input['banner_1'] = replace_thumbnail($input['banner_1']);
            $input['banner_2'] = replace_thumbnail($input['banner_2']);
            $input['banner_3'] = replace_thumbnail($input['banner_3']);
            //cấu hình seo
            $input['slug'] = $request->name;
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $user = $this->model->update($input, $id);
            return redirect()->route('wadmin::category.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    function remove($id){
        try{
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
