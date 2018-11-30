<section class="contents">
    <section id="categoryVisual">
        <h1 class="section"><span>お問い合わせ</span></h1>
    </section>
    <form action="" method="post" id="support-table" name="inqForm">
        <section class="section">
            <h2 class="font24 nobold mB30">ご意見・ご質問をお受けしております。</h2>
            <table>
                <caption><img src="<?= View::img('icn_must.gif'); ?>" alt="必須" class="mustImg"> は必須項目となります。</caption>
                    <tbody>
                        <tr>
                        <th><label>お問い合わせ項目 <img src="<?= View::img('icn_must.gif'); ?>" alt="必須" class="mustImg"></label></th>
                        <td>
                        <label class="radio hdecategCode"><input type="radio" name="f000010543" value="7">会社情報について</label>
                        <label class="radio hdecategCode"><input type="radio" name="f000010543" value="7">製品・サービスについて</label>
                        <label class="radio hdecategCode"><input type="radio" name="f000010543" value="8">新卒採用について</label>
                        <label class="radio hdecategCode"><input type="radio" name="f000010543" value="11">その他</label>
                        </td>
                        </tr>

                        <tr>
                        <th><label for="form_title">タイトル <img src="<?= View::img('icn_must.gif'); ?>" alt="必須" class="mustImg"></label></th>
                        <td><input type="text" name="f000010545" value="" id="form_title" class=""></td>
                        </tr>

                        <tr>
                        <th><label for="form_text">内容<span class="gray">（512文字以内）</span> <img src="<?= View::img('icn_must.gif'); ?>" alt="必須" class="mustImg"></label></th>
                        <td><textarea name="f000010546" cols="40" rows="8" value="" style="ime-mode:active" id="form_text" class="w430area"></textarea></td>
                        </tr>

                        <tr>
                        <th><label for="form_name">お名前<span class="gray"></span> <img src="<?= View::img('icn_must.gif'); ?>" alt="必須" class="mustImg"></label></th>
                        <td><input type="text" name="f000010548" value="" style="ime-mode:active" id="form_name" class=""></td>
                        </tr>

                        <tr>
                        <th><label for="form_mail">メールアドレス <img src="<?= View::img('icn_must.gif'); ?>" alt="必須" class="mustImg"></label></th>
                        <td>
                        <div><input type="text" name="f000010550" value="" style="ime-mode:inactive" id="form_mail" class=" mR10"><span class="gray">（半角）</span></div>
                        <p class="mT10 mB15 lh120">お問い合わせへの返信先となりますので正確にご記入ください。<br>携帯電話のアドレスは受付できません。</p>
                        <div><input type="text" name="f000010550:cf" value="" style="ime-mode:inactive" id="form_mail2" class=" mR10"><span class="gray">（確認用）</span></div>
                        </td>
                        </tr>

                        <tr>
                        <th><label for="form_tel1">電話番号</label></th>
                        <td><input type="text" name="f000011604:a" value="" style="ime-mode:inactive" id="form_tel1" class="w95">
                        <span class="mlr">─</span>
                        <input type="text" name="f000011604:e" value="" style="ime-mode:inactive" id="form_tel2" class="w95">
                        <span class="mlr">─</span>
                        <input type="text" name="f000011604:n" value="" style="ime-mode:inactive" id="form_tel3" class="w95 mR10"><span class="gray">（半角）</span>
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
                <p class="notice">上記の利用目的および取り扱いに同意いただける場合は、「同意して入力内容確認画面へ」ボタンを押してください</p>
                <p class="mT25 btn"><input name="submit" type="submit" value="同意して入力内容確認画面へ">
                <input name="reset" type="reset" value="リセット"></p>
            </section>
        </section>
    </form>
    <section class="section">
        <ul class="mB30">
            <li class="notes">※ お問い合わせなどのご質問に必ずしもお答えできない場合がありますので、ご了承ください。</li>
        </ul>
    </section>
</section>
