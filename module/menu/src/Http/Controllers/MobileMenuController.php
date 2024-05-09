<?php

namespace Menu\Http\Controllers;
use Barryvdh\Debugbar\Controllers\BaseController;
use Menu\Http\Requests\MenuEditRequest;
use Menu\Models\Menu;
use Menu\Repositories\MenuRepository;

class MobileMenuController extends BaseController
{
    protected $model;
    public function __construct(MenuRepository $menuRepository)
    {
        $this->model = $menuRepository;
        $this->langcode = session('lang');
    }
    public function getIndex(){
        $data = Menu::orderBy('sort_order','asc')->where('parent', '=', 0)
            ->where('lang_code',$this->langcode)->where('is_mobile',1)->get();
        $menuModel = $this->model;
        //danh sách danh mục bài viết
        return view('wadmin-menu::mobile.index',[
            'data'=>$data,
            'menuModel'=>$menuModel
        ]);
    }

    function getEdit($id){
        $data = $this->model->find($id);
        //danh sách danh mục bài viết
        $menuModel = $this->model;
        return view('wadmin-menu::mobile.edit',
            ['data'=>$data,
            'menuModel'=>$menuModel,
        ]);
    }

    function postEdit($id, MenuEditRequest $request){
        try{
            $input = $request->except(['_token']);
            $input['thumbnail'] = replace_thumbnail($request->thumbnail);
            $input['is_mobile'] = 1;
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $menu= $this->model->update($input, $id);
            return redirect()->route('wadmin::menu-mobile.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

}
