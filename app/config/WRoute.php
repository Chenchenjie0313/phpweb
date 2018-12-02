<?php 

App::import('http/Request');
App::import('routes/Route');


Route::any("access","access");
Route::any("bxslider","bxslider");
Route::any("event","event");
Route::any("news","news");
Route::any("path","path");
Route::any("products","products");
Route::any("about","about");
Route::any("careers","careers");//採用情報

//アップロード
Route::any("upload",function(){
    return "UploadAction@upload";
});

//お問い合わせいの入力
Route::any("inquiry","|parts,inquiry");
//お問い合わせいの確認
Route::any("inquiry_submit","InquiryAction@submit");
//お問い合わせいの戻る
Route::any("inquiry_back","InquiryAction@back");
//お問い合わせいの完了・送信
Route::any("inquiry_confirmation",function(){
    return "InquiryAction@confirmation";
});


Route::any(WEB_APP_DEFAULT_VIEW_PATH, WEB_APP_DEFAULT_VIEW);