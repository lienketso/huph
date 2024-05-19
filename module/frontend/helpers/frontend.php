<?php

use Menu\Models\Menu;
use Product\Models\Catproduct;

function getAllmenu(){
    $lang = session('lang');
    $menuWise = Menu::orderBy('sort_order','asc')
        ->where('lang_code',$lang)->where('status','active')->where('is_mobile',0)->where('parent',0)
        ->get();
    return $menuWise;
}

function getMenuMobile($type){
    $lang = session('lang');
    $menuWise = Menu::orderBy('sort_order','asc')
        ->where('lang_code',$lang)
        ->where('status','active')
        ->where('is_mobile',1)
        ->where('parent',0)
        ->where('type',$type)
        ->get();
    return $menuWise;
}
function sub($str,$num){
    return mb_substr(strip_tags($str), 0, $num);
}

function getAllCategory(){
		$lang = session('lang');
		$catAll = Catproduct::orderBy('sort_order','asc')
        ->where('lang_code',$lang)->where('status','active')->where('parent',0)
        ->get();
        return $catAll;
    }
function stringDate($time){
    $time = strtotime($time);
    return date('d',$time) .' tháng '.date('m',$time).' ,'.date('Y',$time);
}

function getTags($url,$class,$str){
    $name = (explode(",",$str));
    $total = count($name);
    $html="";
    for($i=0;$i<$total;$i++){
        $slug = str_slug($name[$i],'-','en');
        $html.="<a class='$class' href='".$url."/tags/".$slug."/' title='".$name[$i]."' itemprop='keywords'>".$name[$i]."</a>";
    }
    return $html;
}
