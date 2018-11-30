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
        Route::any("inquiry","inquiry");
    }

}