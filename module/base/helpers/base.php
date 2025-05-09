<?php
use Base\Supports\FlashMessage;
use Category\Models\Category;
use Illuminate\Support\Str;
use Post\Models\Post;
use Product\Models\Product;

if (!function_exists('is_in_dashboard')) {
    /**
     * @return bool
     */
    function is_in_dashboard()
    {
        $segment = request()->segment(1);
        if ($segment === config('SOURCE_ADMIN_ROUTE', 'adminlks')) {
            return true;
        }

        return false;
    }
}

if(!function_exists('menu_url')){
    function menu_url($type,$typeid){
        if($type=='blog'){
           $post = Category::find($typeid);
            return domain_url().'/blog/'.$post->slug;
        }
    }
}

if(!function_exists('percent_price')){
    function percent_price($price,$percent){
        return $price - ($price * ($percent/100));
    }
}

if(!function_exists('price_percent')){
    function price_percent($price,$disprice){
        $percent = ($disprice-$price) / $disprice * 100;
        return floor($percent);
    }
}

if (!function_exists('convert_flash_message')) {
    function convert_flash_message($mess = 'create')
    {
        switch ($mess) {
            case 'create':
                $m = config('messages.success_create');
                break;
            case 'edit':
                $m = config('messages.success_edit');
                break;
            case 'delete':
                $m = config('messages.success_delete');
                break;
            case 'cancel':
                $m = config('messages.cancel');
                break;
            case 'role':
                $m = config('messages.role_error');
                break;
            default:
                $m = config('messages.success_create');
        }

        return $m;
    }
}

if (!function_exists('upload_url')) {
    function upload_url($url){
        return env('APP_URL').'/upload/'.$url;
    }
}
if (!function_exists('public_url')) {
    function public_url($url){
        return env('APP_URL').'/'.$url;
    }
}

if (!function_exists('domain_url')) {
    function domain_url(){
        return env('APP_URL');
    }
}

if (!function_exists('replace_thumbnail')) {
    function replace_thumbnail($thumbnail){
        return str_replace(env('APP_URL').'/public/upload/','',$thumbnail);
    }
}


if (! function_exists('str_slug')) {
    function convert_vi_to_en($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }
}
if (! function_exists('str_slug')) {

    function str_slug($title, $separator = '-', $language = 'en')
    {
        return convert_vi_to_en(Str::slug($title, $separator, $language));
    }
}
if (! function_exists('cut_string')) {

    function cut_string($str, $int)
    {
        if(strlen($str)>$int){
            return Str::substr($str,0,$int).'...';
        }else{
            return substr($str,0,$int);
        }

    }
}



if (! function_exists('format_date')) {
    function format_date($date = '')
    {
        return date_format(new DateTime($date), 'd/m/Y');
    }
}
if (! function_exists('input_format_date')) {
    function input_format_date($date = '')
    {
        $newDate = date("Y-m-d h:i:s", strtotime($date));
        return $newDate;
    }
}
if (! function_exists('format_date_display')) {
    function format_date_display($date = '')
    {
        return date_format(new DateTime($date), 'Y-m-d');
    }
}



if (! function_exists('getProduct')) {
    function getProduct($id)
    {
        $product = Product::find($id);
        return $product;
    }
}

function sw_get_current_weekday() {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $weekday = date("l");
    $weekday = strtolower($weekday);
    switch($weekday) {
        case 'monday':
            $weekday = 'Thứ hai';
            break;
        case 'tuesday':
            $weekday = 'Thứ ba';
            break;
        case 'wednesday':
            $weekday = 'Thứ tư';
            break;
        case 'thursday':
            $weekday = 'Thứ năm';
            break;
        case 'friday':
            $weekday = 'Thứ sáu';
            break;
        case 'saturday':
            $weekday = 'Thứ bảy';
            break;
        default:
            $weekday = 'Chủ nhật';
            break;
    }
    return $weekday.', '.date('d/m/Y');
}

function datetoString($date){
    if(!is_null($date)){
        $newDate = date('d \t\h\á\n\g m \n\ă\m Y', strtotime($date));
    }else{
        $newDate = date('d \t\h\á\n\g m \n\ă\m Y', strtotime(now()));
    }

    return $newDate;
}
function youtubeToembed($link){

    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

    $videoId = '';
    if (preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $link, $matches)) {
        $videoId = $matches[1];
    }

//    if (preg_match($longUrlRegex, $link, $matches)) {
//        $youtube_id = $matches[count($matches) - 1];
//    }
//
//    if (preg_match($shortUrlRegex, $link, $matches)) {
//        $youtube_id = $matches[count($matches) - 1];
//    }
    $fullEmbedUrl = 'https://www.youtube.com/embed/' . $videoId ;
    return $fullEmbedUrl;
}

function GenQrCode($route){
    $pngImage = QrCode::format('svg')
        ->merge(asset('admin/themes/images/logo.png'), 0.3, true)->size(300)->errorCorrection('H')
        ->generate($route);
     return $pngImage;
}


function calculateSEOScore($content, $metaDescription)
{
    $contentLength = str_word_count($content);

    // Điểm tối đa cho độ dài nội dung và mô tả
    $maxLengthScore = 60; // Giả sử nội dung tối đa là 1000 từ (điểm tối đa là 60)
    $maxDescriptionScore = 40; // Giả sử mô tả tối đa là 200 ký tự (điểm tối đa là 40)

    // Tính điểm độ dài nội dung
    $lengthScore = min(($contentLength / 10), $maxLengthScore);

    // Kiểm tra sự tồn tại và độ dài của mô tả
    $descriptionScore = 0;
    if (!empty($metaDescription)) {
        $descriptionLength = strlen($metaDescription);
        if ($descriptionLength > 0 && $descriptionLength <= 200) {
            $descriptionScore = min(($descriptionLength / 5), $maxDescriptionScore);
        }
    }

    // Tính điểm tổng cộng
    $totalScore = $lengthScore + $descriptionScore;

    // Điều chỉnh tổng điểm để đảm bảo tổng cộng là 100
    $totalScore = min(100, $totalScore * (100 / ($maxLengthScore + $maxDescriptionScore)));

    return $totalScore;
}

function countStringVietnam($string){
    $numberOfCharacters = mb_strlen($string, 'UTF-8');
    return $numberOfCharacters;
}

function convertToSlugWithDiacritics($string) {
    // Chuyển sang chữ thường
    $string = mb_strtolower($string, 'UTF-8');

    // Thay thế khoảng trắng bằng dấu gạch ngang
    $string = preg_replace('/\s+/', '-', $string);

    // Loại bỏ dấu gạch ngang ở đầu và cuối chuỗi
    $string = trim($string, '-');

    return convert_vi_to_en($string);
}
