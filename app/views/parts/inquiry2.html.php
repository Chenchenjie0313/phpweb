<link rel="stylesheet" type="text/css" href="<?= View::css('support.css'); ?>" media="all">

<section class="contents">
    <section id="categoryVisual">
        <h1 class="section"><span>お問い合わせ</span></h1>
    </section>
    <form action="" method="post" id="support-table" name="inqForm">
        <section class="section">
            <h2 class="font24 nobold mB30">入力内容をご確認の上、「送信する」ボタンを押してください。</h2>
            <table>
                <caption><img src="<?= View::img('icn_must.gif'); ?>" alt="必須" class="mustImg"> は必須項目となります。</caption>
                    <tbody>
                        <tr>
                        <th><label>お問い合わせ項目 <img src="<?= View::img('icn_must.gif'); ?>" alt="必須" class="mustImg"></label></th>
                        <td>
                            <?= View::outputList('type', [1=>'会社情報について', 2=>'製品・サービスについて', 3=>'新卒採用について', 4=>'その他']) ?>
                        </td>
                        </tr>

                        <tr>
                        <th><label for="form_title">タイトル <img src="<?= View::img('icn_must.gif'); ?>" alt="必須" class="mustImg"></label></th>
                        <td><?= View::output('title') ?></td>
                        </tr>

                        <tr>
                        <th><label for="form_text">内容<span class="gray">（512文字以内）</span> <img src="<?= View::img('icn_must.gif'); ?>" alt="必須" class="mustImg"></label></th>
                        <td><?= View::output('text') ?></td>
                        </tr>

                        <tr>
                        <th><label for="form_name">お名前<span class="gray"></span></label></th>
                        <td><?= View::output('name') ?></td>
                        </tr>

                        <tr>
                        <th><label for="form_mail">メールアドレス</label></th>
                        <td>
                        <div><?= View::output('email') ?><span class="gray">（半角）</span></div>
                        </td>
                        </tr>

                        <tr>
                        <th><label for="form_tel1">電話番号</label></th>
                        <td>
                        <?= View::output('tel_01') ?>
                        <span class="mlr">─</span>
                        <?= View::output('tel_02') ?>
                        <span class="mlr">─</span>
                        <?= View::output('tel_03') ?><span class="gray">（半角）</span>
                        </td>
                        </tr>
                    </tbody>
            </table>
            <ul class="mT10">
                <li class="notes">※ ご記入いただいた個人情報は、お問い合わせへの回答・連絡のみに利用致します。</li>
            </ul>
        </section>
        <section class="bg-gray03">
            <section class="section centerTxt">
                <p class="notice">上記内容でよろしければ、「送信する」ボタンを押してください。</p>
                <p class="mT25 btn">
                <a class="btn btn-primary" style="padding:15px 45px;" href="javascript:void(0);" id="inquiry_send">送信する</a>
                <a class="btn btn-secondary" style="padding:5px;" href="javascript:void(0);" id="inquiry_back">戻る</a></p>
            </section>
        </section>

        <?= View::hidden('type','title','text','name','email','email_02','tel_01','tel_02','tel_03'); ?>
    </form>
    <section class="section">
        <ul class="mB30">
            <li class="notes">※ お問い合わせなどのご質問に必ずしもお答えできない場合がありますので、ご了承ください。</li>
        </ul>
    </section>
</section>

<script>

var flag = false;
//support-table
$('#inquiry_send').on('click', function(){
    if (flag){
        return;
    }
    flag = true;
    $('form[name="inqForm"]').attr('action','<?= View::url('inquiry_submit'); ?>');
    $('form[name="inqForm"]').submit();
});
$('#inquiry_back').on('click', function(){

    if (flag){
        return;
    }
    flag = true;
    $('form[name="inqForm"]').attr('action','<?= View::url('inquiry_back'); ?>');
    $('form[name="inqForm"]').submit();
});



</script>