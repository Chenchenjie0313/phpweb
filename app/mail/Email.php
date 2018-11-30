<?php


App::import('mail/lib/PHPMailer');
App::import('mail/lib/SMTP');
//App::import('mail/lib/OAuth');

/**
 * 
 * メール送信
 * 
 */
class Email{
    
    private static $target = null;

    public static function create(){
        if (self::$target == null){
            self::$target = new Email();
        }
        return self::$target;
    }


    private $mailer = null;

    private function __construct(){
        try {
            $this->mailer = new PHPMailer();
            // SMTPを使用するようにPHPMailerに指示する - メールサーバが必要
            $this->mailer->IsSMTP();//SMTPを作成
            //$this->mailer->SMTPAuth = true;
            $this->mailer->Host = SETTINGS['mail_stmp']['smtp_host'];//SMTPサーバー
            $this->mailer->CharSet = SETTINGS['mail_stmp']['charset'];//文字セットこれでOK
            $this->mailer->SMTPAuth = TRUE;//SMTP認証を有効にする
            $this->mailer->Username = SETTINGS['mail_stmp']['username']; // ユーザー名
            $this->mailer->Password = SETTINGS['mail_stmp']['password']; // Gmailのパスワード
            //$mailer->SMTPSecure = 'tls';//SSLも使えると公式で言ってます
            $this->mailer->Port = 587;//tlsは587でOK
            //$this->mailer->SMTPDebug = 0;//2は詳細デバッグ1は簡易デバッグ本番はコメントアウトして
            $this->mailer->From = SETTINGS['mail_stmp']['username']; //差出人の設定

        } catch (Exception $e){
            Logger::log(__METHOD__.",行:".__LINE__, $e);
            $this->mailer = null;
        }

    }

    /***
     * サポート者にメールを送信
     */
    public function sendMailFromSupporter(/** 送信先 */$to, /** 件名 */$title, /** メール本 */$message){
        Logger::log(__METHOD__.",行:".__LINE__, "送信開始。。。");

        if ($this->mailer == null){
            Logger::log("送信失敗しました。", "[TO]:{$to}, [件名の設定] : {$title}, [本文]：{$message}");
            return false;
        }
        try{
            // $this->mailer->FromName = mb_convert_encoding("[サイト・問い合わせ]","UTF-8","AUTO");
            // $this->mailer->Subject  = mb_convert_encoding($title,"UTF-8","AUTO");//件名の設定
            // $this->mailer->Body     = mb_convert_encoding($message,"UTF-8","AUTO");//メッセージ本体
            $this->mailer->FromName = "[サイト・問い合わせ]";
            $this->mailer->Subject  = $title;//件名の設定
            $this->mailer->Body     = $message;//メッセージ本体
            $this->mailer->AddAddress($to); // To宛先
            //送信する
            if($this->mailer->Send()){
                Logger::log(__METHOD__.",行:".__LINE__, "送信しました。", "[TO]:{$to}, [件名の設定] : {$title}, [本文]：{$message}", $e);
                return true;
            } else {
                throw new Exception("送信失敗しました。");
            }
        } catch (Exception $e){
            Logger::log(__METHOD__.",行:".__LINE__, "送信失敗しました。", "[TO]:{$to}, [件名の設定] : {$title}, [本文]：{$message}", $e);
            $this->mailer = null;
        }
        return false;

    }


}

