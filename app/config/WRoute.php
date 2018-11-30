<?php 

App::import('http/Request');
App::import('routes/Route');


Route::any("/",WEB_APP_DEFAULT_VIEW);
Route::any("access","access");
Route::any("bxslider","bxslider");
Route::any("event","event");
Route::any("news","news");
Route::any("path","path");
Route::any("products","products");
Route::any("about","about");
Route::any("careers","careers");//採用情報

//お問い合わせいの入力
Route::any("inquiry","|parts,inquiry");
//お問い合わせいの確認
Route::any("inquiry_submit","InquiryAction@submit");
Route::any("inquiry_back","InquiryAction@back");
Route::any("inquiry_confirmation",function(){
    // $token = Session::create()->get('web_app_token');
    // if ($token != null && $token == Request::create()->input('web_app_token')){
    //     return "InquiryAction@confirmation";
    // }
    // return "index";
    return "InquiryAction@confirmation";
});