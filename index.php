<?php
error_reporting(E_ERROR | E_PARSE);

define('BASE_WEB_ROOT', __DIR__);

define('APP_SLASH', '/');

// define('WEB_APP_DEFAULT_VIEW', 'index');
define('WEB_APP_DEFAULT_VIEW', 'layout2|index');

require_once BASE_WEB_ROOT.'/app/App.php';

App::import('exception/WException');
App::import('helper/View');
App::import('log/Logger');
App::import('dispatch/Dispatch');

try{

    // Logger::log(__METHOD__.",行:".__LINE__, "設定開始");
    //Read config    
    App::import('config/WRoute');
    App::import('config/StartApp');
    // Logger::log(__METHOD__.",行:".__LINE__, "設定完了");

    // Logger::log(__METHOD__.",行:".__LINE__, "URL:". Request::create()->getUri());

    // App::import('db/MyPDO');
    // $dbre = MyPDO::create()->select('select * from blog where id = :id',[':id'=>0]);
    // Logger::log(__METHOD__.",行:".__LINE__, $dbre);

    $target = Dispatch::create()->excute();

    //結果が文字列の場合、
    if ($target === false){
        //処理なし
        Logger::log(__METHOD__.",行:".__LINE__, "処理なし");
    }
    else if (is_string($target)){
        Logger::log(__METHOD__.",行:".__LINE__, "{$target}");
        $viewData = Request::create()->view();
        $prePageData = WArray::create()->put('target', $target)->put('viewData', $viewData);
        Session::create()->put("prePageData", prePageData);
        View::view($target);
    }
    else {
        Logger::log(__METHOD__.",行:".__LINE__, "ディフォルト画面へ");
        View::view(WEB_APP_DEFAULT_VIEW);
    }
    

}catch(Exception $e){
    // Logger::log(__METHOD__.",行:".__LINE__, $e);
    // if ($e instanceof WException){
    //     View::view("errors,error");
    // } else {
    //     View::view(WEB_APP_DEFAULT_VIEW);
    // }
}




// App::import('/web/const/config.php');
// App::import('/web/const/const.php');
// App::import('/web/lib/util/stringHelper.php');
// App::import('/web/lib/util/utils.php');
// App::import('/web/lib/util/sqlHelper.php');
// App::import('/web/lib/util/validator.php');
// App::import('/web/lib/util/documentHelper.php');
// App::import('/web/lib/session/sessionHelper.php');

// App::import('/web/lib/log/logger.php');
// App::import('/web/lib/http/request.php');
// App::import('/web/lib/forward.php');
// App::import('/web/lib/controller.php');




// try{
	
// 	//1.HTTPのインスタンスを生成する。
// 	Logger::log("処理開始......");
// 	Logger::log("1=>" . Request::newInstance()->input("sys_params001"));
// 	Logger::log("2=>" . Request::newInstance()->input("sys_params002"));
// 	Logger::log("3=>" . Request::newInstance()->input("sys_params003"));
// 	Logger::log("パラメタ　： ", Request::newInstance()->all());

// 	//2.指定したクラス、メソッドを実行する。
// 	Logger::log(__FILE__, "指定したクラス、メソッドを実行する。開始。。。");
// 	$forward = Controller::create()->run();

// 	if (!($forward instanceof Forward)){
// 		throw new Exception("forwad type is error!");
// 	}
// 	Logger::log(__FILE__, "指定したクラス、メソッドを実行する。完了");
// 	//3.2で実行結果より、クライアントに返却

// 	// SessionHelper::OpenSession();	
// 	// Utils::WriteLog('IP : ' . Utils::ip());
// 	// Utils::WriteLog('パラメタ : ', App::instance()->get());

// 	// $action = $_REQUEST['action'];
// 	// $method = $_REQUEST['method'];

// 	// $action = Request::newInstance()->input('action');
// 	// $method = Request::newInstance()->input('method');

// 	// Logger::log($action, $method);

// 	// if($action != null && $method != null){
// 	// 	$controller = new Controller();
// 	// 	$forward = $controller->run($action, $method);
// 	// }

// 	//トークン発行
// 	$token = SessionHelper::get("user_token");
// 	if($token == null){
// 		SessionHelper::put("user_token", Utils::userToken());
// 	}
// 	Logger::log(__FILE__, "トークン発行");

// 	//HTTP_AJAX
// 	if(Request::newInstance()->header('HTTP_AJAX')){
// 		Logger::log(__FILE__, "クライアントに返却[AJAX]");
// 		//HTML文章をリターンする
// 		if($forward->input("type") == "AJAX_PAGE"){
// 			//文字コードはUTF-8
// 			header('conten-type:text/html;charset=utf-8');
// 			//キャッシュさせたくない
// 			header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
// 			header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
// 			header( 'Cache-Control: no-store, no-cache, must-revalidate' );
// 			header( 'Pragma: no-cache' );
// 			Logger::log(__FILE__, __LINE__, "Ajax page : " , $forward->iput("page"));
// 			if(!StringHelper::isRealEmpty($forward)){
// 				App::include($forward->iput("page"));
// 			}
// 		} else {
// 			Logger::log(__FILE__, "クライアントに返却[AJAX][JSON]");
// 			//JSONデータをリターンする
// 			//文字コードはUTF-8
// 			header('Content-Type:application/json;charset=utf-8');
// 			// echo json_encode($forward, true);
// 			// if (json_last_error() !== 0){
// 			// 	Logger::log("JSON : " , json_last_error(), json_last_error_msg());
// 			// }
// 			$returnJson = Request::newInstance()->outputToJson();
// 			Logger::log(__FILE__, __LINE__, "Ajax Json : ", $returnJson);
// 			echo $returnJson;

// 		}
// 	} 
// 	//PAGE
// 	else {
// 		//文字コードはUTF-8
// 		header('conten-type:text/html;charset=utf-8');
// 		header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
// 		header( 'Cache-Control: no-store, no-cache, must-revalidate' );
// 		//header( 'Cache-Control: post-check=0, pre-check=0', false );
// 		header( 'Pragma: no-cache' );

// 		Logger::log(__FILE__, __LINE__, "遷移先 : 「{$forward->input('page')}」です。" , 1);
// 		if(StringHelper::isRealEmpty($forward->input('page'))){
// 			$forward = DEFAULT_HTML; 
// 		}
// 		Logger::log("page : " + $forward->input("page"));
// 		App::include($forward->input("page"));
// 	}

// } catch (Exception $e){
// 	Logger::log("例外が発生しました。",$e->getMessage());
// 	if($isAjax){
// 		if($_REQUEST['dataType']==='html'){
// 			//文字コードはUTF-8
// 			header('conten-type:text/html;charset=utf-8');
// 			//キャッシュさせたくない
// 			header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
// 			header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
// 			header( 'Cache-Control: no-store, no-cache, must-revalidate' );
// 			//header( 'Cache-Control: post-check=0, pre-check=0', false );
// 			header( 'Pragma: no-cache' );
// 			echo "<div><spna>Error!</span></div>";
// 			//App::include('/html/parts/error.html.php');
// 		} else {
// 			//文字コードはUTF-8
// 			header('Content-Type:application/json;charset=utf-8');
// 			echo json_encode([statuscode => 99]);
// 		}
// 	} else {
// 		//文字コードはUTF-8
// 		header('conten-type:text/html;charset=utf-8');
// 		//キャッシュさせたくない
// 		header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
// 		header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
// 		header( 'Cache-Control: no-store, no-cache, must-revalidate' );
// 		//header( 'Cache-Control: post-check=0, pre-check=0', false );
// 		header( 'Pragma: no-cache' );
// 		App::include(DEFAULT_HTML);
// 	}
// }
// Helper::close();
// Logger::log("処理終了......");



