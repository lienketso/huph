<?php


namespace Transaction\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Transaction\Repositories\TransactionRepository;

class TransactionController extends BaseController
{
    protected $model;
    public function __construct(TransactionRepository $transactiontRepository)
    {
        $this->model = $transactiontRepository;
    }

    public function getIndex(Request $request){

        $name = $request->get('name');
        if($name){
            $data = $this->model->scopeQuery(function($e) use ($name){
                return $e->orderBy('id','desc')->where('name','LIKE','%'.$name.'%')->orWhere('phone',$name);
            })->paginate(10);
        }
        else{
            $data = $this->model->orderBy('created_at','desc')->paginate(10);
        }

        return view('wadmin-transaction::index',['data'=>$data]);
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
