<?php


namespace Frontend\Http\Controllers;


use App\Mail\SendMail;
use Barryvdh\Debugbar\Controllers\BaseController;
use Category\Repositories\CategoryRepository;
use Company\Repositories\CompanyRepository;
use Contact\Http\Requests\ContactCreateRequest;
use Contact\Repositories\ContactRepository;
use Gallery\Repositories\GalleryRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Newsletter\Repositories\NewsletterRepository;
use Post\Repositories\PostRepository;
use Product\Repositories\CatproductRepository;
use Product\Repositories\ProductRepository;
use Scores\Models\Scores;
use Scores\Repositories\ScoresRepository;
use Setting\Models\Setting;
use Setting\Repositories\SettingRepositories;
use Transaction\Http\Requests\TransactionCreateRequest;
use Transaction\Repositories\TransactionRepository;

class HomeController extends BaseController
{
    protected $catnews;
    protected $lang;
    protected $cat;
    protected $ga;
    protected $po;
    protected $post;
    public function __construct(CategoryRepository $categoryRepository,CatproductRepository $catproductRepository,
                                GalleryRepository $galleryRepository, ProductRepository $productRepository, PostRepository $postRepository)
    {
        $this->lang = session('lang');
        $this->catnews = $categoryRepository;
        $this->cat = $catproductRepository;
        $this->ga = $galleryRepository;
        $this->po = $productRepository;
        $this->post = $postRepository;
    }

    private $langActive = ['vn','en','ch'];
    public function changeLang(Request $request, $lang){
        if(in_array($lang,$this->langActive)){
            $request->session()->put(['lang'=>$lang]);
            return redirect()->route('frontend::home');
        }
    }
    function getIndex(PostRepository $postRepository){

        $gallery = $this->ga->scopeQuery(function ($e){
            return $e->orderBy('sort_order','asc')
                ->where('status','active')
                ->where('group_id',2);
        })->limit(50);

        $popups = $this->ga->scopeQuery(function ($e){
            return $e->orderBy('sort_order','asc')
                ->where('status','active')
                ->where('group_id',4);
        })->first();

        $pageAbout = $postRepository->findWhere(['lang_code'=>$this->lang,'status'=>'active','display'=>1,'post_type'=>'page'])->first();
        //page home 2
        $pageHome = $postRepository->findWhere(['lang_code'=>$this->lang,'status'=>'active','display'=>2,'post_type'=>'page'])->all();

        $latestNews = $postRepository->scopeQuery(function($e){
            return $e->orderBy('created_at','desc')
                ->where('lang_code',$this->lang)
                ->where('status','active')
                ->where('post_type','blog')
                ->where('is_home',1)
                ->get();
        })->limit(8);
        //tuyển sinh trang chủ
        $categoryTuyensinh = $this->catnews->orderBy('sort_order','asc')
            ->where('status','active')
            ->where('parent',10)->get();
        //Tin Slider


        //danh mục tin trang chủ
        $catnewsHomes = $this->catnews->findWhere([
            'status'=>'active',
            'cat_type'=>'post',
            'display'=>1
        ])->first();


        $catTT = $this->catnews->scopeQuery(function($e){
            return $e->orderBy('sort_order','asc')
                ->where('parent',0)
                ->where('status','active')
                ->where('cat_type','daotao')
                ->where('lang_code',$this->lang)
                ->where('display',1);
        })->first();

        return view('frontend::home.index',[
            'gallery'=>$gallery,
            'catTT'=>$catTT,
            'latestNews'=>$latestNews,
            'pageAbout'=>$pageAbout,
            'popups'=>$popups,
            'categoryTuyensinh'=>$categoryTuyensinh,
            'pageHome'=>$pageHome
        ]);
    }
    public function about(SettingRepositories $settingRepositories, PostRepository $postRepository){
        $checkList = $settingRepositories->getSettingMeta('about_section_list_1_title_'.$this->lang);
        $decodeCheck = json_decode($checkList);
        $decodeCheck = array_chunk($decodeCheck,4);

        //page to page
        $pageList = $postRepository->scopeQuery(function($e){
            return $e->orderBy('created_at','desc')
                ->where('status','active')
                ->where('lang_code',$this->lang)
                ->where('display',3);
        })->limit(5);

        return view('frontend::home.about',['decodeCheck'=>$decodeCheck,'pageList'=>$pageList]);
    }

    public function contact(SettingRepositories $settingRepositories){
        return view('frontend::contact.contact');
    }
    public function postContact(ContactCreateRequest $request, ContactRepository $contactRepository, SettingRepositories $settingRepositories){
            $emailSetting = $settingRepositories->getSettingMeta('site_email_vn');
            $input = $request->except(['_token']);
            $data = [
                'title'=>$input['title'],
                'name'=>$input['name'],
                'phone'=>$input['phone'],
                'messenger'=>$input['messenger']
            ];
            $contactRepository->create($data);
            $details = [
                'name'=> $input['name'],
                'phone'=> $input['phone'],
                'title'=>$input['title'],
                'messenger'=>$input['messenger']
            ];
            Mail::to($emailSetting)
                ->send(new SendMail($details));
//            Mail::send('frontend::mail.contact',['name'=>$input['name'],'email'=>$input['email'],'title'=>$input['title'],'messenger'=>$input['messenger']],
//                function ($message){
//                    $message->to('thanhan1507@gmail.com', 'Visitor')->subject('Liên hệ từ website viện nghiên cứu !');
//                });
            return view('frontend::contact.success',['data'=>$input]);
    }

    public function createNewletter(Request $request, NewsletterRepository $newsletterRepository){
        $email = $request->get('email');
        $input = ['email'=>$email];
        $newsletterRepository->create($input);
        echo 'Subscribe successful !';
    }

    public function createPartner(TransactionCreateRequest $request, TransactionRepository $transactionRepository){
        $input = $request->except(['_token']);
        try{
            $create = $transactionRepository->create($input);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function submitForm(Request $request, ContactRepository $contactRepository, SettingRepositories $settingRepositories){
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
        ]);
        $name = $request->name;
        $phone = $request->phone;
        $data = [
            'name'=>$name,
            'phone'=>$phone,
            'title'=>'Form liên hệ',
            'messenger'=>'Thông tin liên hệ từ form tuyển sinh'
        ];
        try {
            $contactRepository->create($data);
            $details = [
                'name'=> $name,
                'phone'=> $phone,
                'title'=>'Form liên hệ',
                'messenger'=>'Thông tin liên hệ từ form tuyển sinh'
            ];
            //send mail
            $emailSetting = $settingRepositories->getSettingMeta('site_email_vn');
            Mail::to($emailSetting)
                ->send(new SendMail($details));
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function findAdmission(Request $request, ScoresRepository $scoresRepository){
        $cccd = $request->cccd;
        try {
            $thisinh = null;
            $listThisinh = Scores::where('cccd_number',$cccd)->first();
            if(!is_null($listThisinh)){
                $thisinh = response()->json($listThisinh);
            }else{
                $thisinh = '404';
            }
            return $thisinh;
        }catch (\Exception $e){
            return response()->json($e->getMessage());
        }
    }

    //load tuyển sinh home
    public function loadTuyenSinhHome(Request $request){
        $id = $request->categoryid;
        $category = $this->catnews->find($id);
        if($category){
            $data = $category->posts()->where('display',1)->limit(3)->get()->map(function ($m){
                $m->author = ($m->user()->exists()) ? $m->user->full_name : 'admin';
                return $m;
            });
            return response()->json($data);
        }else{
            return response()->json([
                'error' => 'post not found'
            ], 404);
        }
    }


}
