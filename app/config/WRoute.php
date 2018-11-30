<?php 

App::import('routes/Route');
class WRoute {

    public static function setUp(){
        Route::any("/","index");
        
        Route::any("access","access");
        Route::any("bxslider","bxslider");
        Route::any("event","event");
        Route::any("news","news");
        Route::any("path","path");
        Route::any("products","products");
        Route::any("about","about");
        Route::any("careers","careers");//採用情報
        
        //お問い合わせいの入力
        Route::layout("inquiry","parts,inquiry");
        //お問い合わせいの確認
        Route::layout("inquiry_submit","InquiryAction@submit");
        Route::layout("inquiry_back","InquiryAction@back");
        Route::layout("inquiry_confirmation","InquiryAction@confirmation");
        
    }

}