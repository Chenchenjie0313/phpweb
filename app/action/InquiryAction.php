<?php

App::import('action/Action');
App::import('mail/Email');

/**
 * 
 */
class  InquiryAction extends Action{

    public function __construct(){
    }

    /**
     * 確認画面から入力画面へ
     * 
     */
    public function back(){
        Logger::log(__METHOD__.",行:".__LINE__, "確認画面から入力画面へ");

        //設定初期値
        Request::create()->copyInputToView('type','title','text','name','email','email_02','tel_01','tel_02','tel_03');
        return "|parts,inquiry";
    }

    /**
     * 入力した値を登録する。
     * 
     */
    public function submit(){
        Logger::log(__METHOD__.",行:".__LINE__, "入力した値を登録する。");
        
        //設定初期値
        Request::create()->copyInputToView('type','title','text','name','email','email_02','tel_01','tel_02','tel_03');

        $type = Request::create()->input('type');
        if ($type == 1){
            $type = '会社情報について';
        } else if ($type == 2){
            $type = '製品・サービスについて';
        } else if ($type == 3){
            $type = '新卒採用について';
        } else if ($type == 4){
            $type = 'その他';
        }
        $text = Request::create()->input('text');
        $name = Request::create()->input('name');
        $email = Request::create()->input('email');

        $tel_01 = Request::create()->input('tel_01');
        $tel_02 = Request::create()->input('tel_02');
        $tel_03 = Request::create()->input('tel_03');

        $tel = "{$tel_01}-{$tel_01}-{$tel_01}";
        
        $message = <<<EOF
【お問い合わせ項目】{$type}
【お名前】{$name}
【メールアドレス】{$email}
【内容】{$text}
EOF;
        //送信する。
        if (Request::create()->checkToken()){
            Email::create()->sendMailFromSupporter(/** 送信先 */'tinofmail@gmail.com', /** 件名 */'[サイト・問い合わせ]'.Request::create()->input('title'), /** メール本 */$message);
        }
        return "|parts,inquiry3";
    }

    /**
     * 入力画面から確認画面へ
     * 
     */
    function confirmation(){
        Logger::log(__METHOD__.",行:".__LINE__, "入力画面から確認画面へ");

        if (!Request::create()->checkToken()) {
            Request::create()->error('header',"不正の操作が行いました。");
        }

        $type = Request::create()->input('type');
        Request::create()->view('type', $type);
        if (WString::isEmpty($type)){
            Request::create()->error('type',"お問い合わせ項目を入力してください。");
        }

        $title = Request::create()->input('title');
        Request::create()->view('title', $title);
        if (WString::isEmpty($title)){
            Request::create()->error('title',"タイトルを入力してください。");
        }

        $text = Request::create()->input('text');
        Request::create()->view('text', $text);
        if (WString::isEmpty($text)){
            Request::create()->error('text',"内容を入力してください。");
        }

        $name = Request::create()->input('name');
        Request::create()->view('name', $name);
        // if (WString::isEmpty($name)){
        //     Request::create()->error('name',"お名前を入力してください。");
        // }

        $email = Request::create()->input('email');
        $email_02 = Request::create()->input('email_02');
        Request::create()->view('email', $email);
        Request::create()->view('email_02', $email_02);
        // if (WString::anyEmpty($email, $email_02)){
        //     Request::create()->error('email',"メールアドレスを入力してください。");
        // } else 
        if ($email !== $email_02){
            Request::create()->error('email',"メールアドレスを正しく入力してください。");
        }

        $tel_01 = Request::create()->input('tel_01');
        Request::create()->view('tel_01', $tel_01);
        $tel_02 = Request::create()->input('tel_02');
        Request::create()->view('tel_02', $tel_02);
        $tel_03 = Request::create()->input('tel_03');
        Request::create()->view('tel_03', $tel_03);

        if (Request::create()->hasError()){
            Logger::log(__METHOD__.",行:".__LINE__, Request::create()->error());
            return "|parts,inquiry";
        }

        return "|parts,inquiry2";
    }
}