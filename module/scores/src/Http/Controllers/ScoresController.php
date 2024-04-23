<?php

namespace Scores\Http\Controllers;
use App\Imports\ScoresImport;
use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Scores\Http\Requests\ScoresCreateRequest;
use Scores\Models\Scores;
use Scores\Repositories\ScoresRepository;

class ScoresController extends BaseController
{
    protected $model;
    public function __construct(ScoresRepository $scoresRepository)
    {
        $this->model = $scoresRepository;
    }

        public function import(Request $request)
        {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls',
            ]);
            $file = $request->file('file');
            Excel::import(new ScoresImport,$file);
            return back()->with('create','Import dữ liệu thành công !');
        }

        public function getIndex(Request $request){
            $id = $request->get('id');
            $name = $request->get('name');

            $q = Scores::query();
            if(!is_null($id)){
                $q = $q->where('id',$id);
            }
            if(!is_null($name)){
                $q = $q->where('name','LIKE','%'.$name.'%');
            }


            $data = $q->orderBy('created_at','desc')->paginate(20);

            return view('wadmin-scores::index',compact('data'));
        }

    public function getCreate(){
        return view('wadmin-scores::create');
    }

    public function postCreate(ScoresCreateRequest $request){
        try{
            $input = $request->except(['_token','continue_post']);
            $data = $this->model->create($input);
            //continue post if click continue
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::scores.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::scores.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    public function getEdit($id){
        $data = $this->model->find($id);
        return view('wadmin-scores::edit',['data'=>$data]);
    }

    function postEdit($id, ScoresCreateRequest $request){

        try{
            $input = $request->except(['_token','continue_post']);
            $scores = $this->model->update($input, $id);

            return redirect()->route('wadmin::scores.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
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


}
