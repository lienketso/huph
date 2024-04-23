<?php

namespace Category\Http\Controllers;
use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Category\Http\Requests\CategoryCreateRequest;
use Category\Http\Requests\CategoryEditRequest;
use Category\Models\Category;
use Category\Repositories\CategoryRepository;
use Illuminate\Http\Request;
class AddmissionCategoryController extends BaseController
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

        if(!is_null($id)){
           $q->where('id',$id);
        }
        if(!is_null($name)){
            $q->where('name','LIKE','%'.$name.'%');
        }
        $data = $q->orderBy('created_at','desc')
            ->where('lang_code',$this->langcode)
            ->where('cat_type','tuyensinh')
            ->paginate(15);
        $model = $this->model;
        return view('wadmin-category::addmission.index',['data'=>$data,'model'=>$model]);
    }
    public function getCreate(){
        $model = $this->model;
        return view('wadmin-category::addmission.create',['model'=>$model]);
    }
    public function postCreate(CategoryCreateRequest $request){
        try{
            $input = $request->except(['_token','continue_post']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['banner'] = replace_thumbnail($input['banner']);
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
                    ->route('wadmin::cat-addmission.index.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::cat-addmission.index.get')
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEdit($id){
        $data = $this->model->find($id);
        $model = $this->model;
        return view('wadmin-category::addmission.edit',['data'=>$data,'model'=>$model]);
    }

    function postEdit($id, CategoryEditRequest $request){
        try{
            $input = $request->except(['_token']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['banner'] = replace_thumbnail($input['banner']);
            //cấu hình seo
            $input['slug'] = $request->name;
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $user = $this->model->update($input, $id);
            return redirect()->route('wadmin::cat-addmission.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
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
