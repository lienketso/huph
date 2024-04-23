<?php


namespace Product\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Media\Models\Media;
use Media\Repositories\MediaRepository;
use Mockery\Exception;
use Product\Http\Requests\CatEditRequest;
use Product\Http\Requests\ProductCreateRequest;
use Product\Http\Requests\ProductEditRequest;
use Product\Models\Options;
use Product\Models\OptionValue;
use Product\Models\Product;
use Product\Models\ProductMeta;
use Product\Repositories\CatproductRepository;
use Product\Repositories\FactoryRepository;
use Product\Repositories\ProductRepository;
use Product\Repositories\MetaRepository;
use Gallery\Repositories\GalleryRepository;


class ProductController extends BaseController
{
    protected $model;
    protected $cat;
    protected $langcode;
    protected $fac;
    protected $ga;
    protected $meta;
    public function __construct(ProductRepository $productRepository,CatproductRepository $catproductRepository, FactoryRepository $factoryRepository, GalleryRepository $galleryRepository, MetaRepository $metaRepository)
    {
        $this->model = $productRepository;
        $this->cat = $catproductRepository;
        $this->fac = $factoryRepository;
        $this->ga = $galleryRepository;
        $this->meta = $metaRepository;
        $this->langcode = session('lang');
    }

    public function getIndex(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');
        $factory_id = $request->factory_id ;

        $q = Product::query();
        if(!is_null($id)){
           $q = $q->where('id',$id);
        }
        if(!is_null($name)){
            $q = $q->where('name','LIKE','%'.$name.'%');
        }


        $data = $q->orderBy('created_at','desc')
            ->where('lang_code',$this->langcode)->paginate(20);

        return view('wadmin-product::index',['data'=>$data,'langcode'=>$this->langcode]);
    }
    public function getCreate(MediaRepository $mediaRepository){
        $currentId = Product::orderBy('id', 'desc')->first()->id + 1;
        $catmodel = $this->cat;
        $factory = $this->fac->findWhere(['status'=>'active','lang_code'=>$this->langcode]);
        $imageAttach = $mediaRepository->findWhere(['table_id'=>$currentId])->all();

        $gallery = $this->ga->orderBy('sort_order')->findWhere(['group_id'=>3])->all();

        return view('wadmin-product::create',['catmodel'=>$catmodel,'factory'=>$factory,'currentId'=>$currentId,'imageAttach'=>$imageAttach,'gallery'=>$gallery]);
    }
    public function postCreate(ProductCreateRequest $request, MediaRepository $mediaRepository){
        try{
            $input = $request->except(['_token','continue_post']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['slug'] = $request->name;
            $input['user_post'] = Auth::id();
            $input['user_edit'] = Auth::id();
            $input['lang_code'] = $this->langcode;
            $input['count_view'] = 0;
            $input['main_display'] = 1;
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $data = $this->model->create($input);
            //upload multi file
            if ($request->hasfile('media')) {
                $files = $request->file('media');
                foreach($files as $file){
                    $path = date('Y').'/'.date('m').'/'.date('d');
                    $newnname = time().'-'.$file->getClientOriginalName();
                    $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                    $file->move('upload/'.$path,$newnname);
                    $media = [
                        'table'=>'product',
                        'table_id'=> $data->id,
                        'name'=> $path.'/'.$newnname ,
                        'original_name'=> $file->getClientOriginalName(),
                        'path_name'=> 'upload/'.$path.'/'.$newnname
                    ];
                    $mediaRepository->create($media);
                }
            }

            //nếu check color
            if($request->input('enable_color')==1){
                $metas = new ProductMeta();
                $arg = $request->input();
                $arg['product_id'] = $data->id;
                if (!empty($arg['colors'])) {
                    $arg['colors'] = array_values($arg['colors']);
                }
                $arg['enable_color'] = $request->input('enable_color');
                $arg['enable_size'] = $request->input('enable_size');
                $metas->fill($arg);
                try{
                    $metas->save();
                }catch (\Exception $e){
                    return $e->getMessage();
                }

            }
            //nếu check size
            if($request->input('enable_size')==1){
                $metas = new ProductMeta();
                $arg = $request->input();
                $arg['product_id'] = $data->id;
                if (!empty($arg['size'])) {
                    $arg['size'] = array_values($arg['size']);
                }
                $arg['enable_color'] = $request->input('enable_color');
                $arg['enable_size'] = $request->input('enable_size');
                $metas->fill($arg);
                try{
                    $metas->save();
                }catch (\Exception $e){
                    return $e->getMessage();
                }

            }

            //continue post if click continue
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::product.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::product.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEdit($id,MediaRepository $mediaRepository){
        $data = $this->model->find($id);
        $catmodel = $this->cat;
        $imageAttach = $mediaRepository->findWhere(['table_id'=>$id])->all();
        $gallery = $this->ga->orderBy('sort_order')->findWhere(['group_id'=>3])->all();

        return view('wadmin-product::edit',['data'=>$data,'catmodel'=>$catmodel,'imageAttach'=>$imageAttach, 'gallery'=>$gallery]);
    }

    function postEdit($id, ProductEditRequest $request){

        try{
            $input = $request->except(['_token','continue_post']);
            if(!is_null($request->input('thumbnail'))){
                $input['thumbnail'] = replace_thumbnail($request->input('thumbnail'));
            }

            $input['slug'] = $request->name;
            $input['cat_id'] = $request->cat_id;
            $input['user_edit'] = Auth::id();
            $input['lang_code'] = $this->langcode;
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
                $product = $this->model->update($input, $id);

            return redirect()->route('wadmin::product.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            dd($e->getMessage());
//            return redirect()->back()->withErrors(config('messages.error'));
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
