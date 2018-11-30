<header id="header">
<div id="headerIn">
<div id="headerLogo"><a href="<?= View::url('/'); ?>"><img src="<?= View::img('logo.png'); ?>" alt="三一株式会社" style="width:32px;height:32px;"></a><span>三一株式会社</span></div>
</div>
<div id="gNaviWrap">
<div class="toggle" id="header_open_btn"></div>
<nav id="gNavi">
  <ul id="mNavi">
    <li class="mNav01"><a href="<?= View::url('/'); ?>">ホーム</a></li>
    <li class="mNav02"><a href="<?= View::url('products'); ?>">商品・サービス</a></li>
    <li class="mNav03"><a href="<?= View::url('news'); ?>">イベント・ニュース</a></li>
    <li class="mNav04"><a href="<?= View::url('about'); ?>">企業情報</a>
      <ul>
        <li><a href="<?= View::url('about'); ?>">会社概要</a></li>
        <li><a href="<?= View::url('about'); ?>">経営方針</a></li>
      </ul>
    </li>
    <li class="mNav05"><a href="<?= View::url('careers'); ?>">採用情報</a></li>
    <li class="mNav06"><a href="<?= View::url('inquiry'); ?>">お問い合わせ</a></li>
    <li class="mNav07"><a href="<?= View::url('access'); ?>">所在地・アクセス</a></li>
  </ul>

  <ul id="fNavi">
  <li class="fNav03"><a href="javascript:void(0);" id="nav_qrcode" >QRコード</a></li>
  <li class="fNav02"><a href="<?= View::url('inquiry'); ?>" >お問い合わせ</a></li>
  <li class="fNav04"><a href="http://www.sanyiasset.com/">中国語</a></li>
  </ul>
</nav>
</div>
<script type="text/javascript">
$(function() {

	var $menu= $('#gNavi');
    var $submenu= $('#localNavi');
    
	$('#header_open_btn').on('click', function(){
        $menu.toggleClass('open');
    });
    
	 
	$('#localNavi a').on('click', function(){
		$submenubtn.removeClass('open');
		$submenu.removeClass('open');
    });
    
    //ヘッダー縮小 処理
    $(document).on('scroll', function(){
        if ( $(window).scrollTop() > 0 ) {
            $("#header").addClass("smaller");
			$("#categoryVisual").addClass("smaller");
			$("#main_contents2").addClass("smaller");
		} else if ( $("#header").hasClass("smaller") ) {
            $("#header").removeClass("smaller");
            $("#categoryVisual").removeClass("smaller");
            $("#main_contents2").removeClass("smaller");
        }
    });

    //QRコード
    $('#nav_qrcode').on('click', function(){
        console.log("qr.....");
        //URL
        $url = '<?= View::img('qr.png'); ?>';
        //alert:
        var html = '<div class="modal qr_alert_modal"  style="display:block;z-index:9999">' + 
                     '<div class="modal-dialog">' + 
                       '<div class="modal-content">' + 
                         '<div class="modal-header">' + 
                           '<h4 class="modal-title" style="font-weight: bold;border-left:5px solid #0a2986;">三一株式会社のホームページのQRコード</h4>' + 
                           '<button type="button" class="close" data-dismiss="modal">&times;</button>' + 
                         '</div>' + 
                         '<div class="modal-body" style="margin: auto;"><img src="' + $url + '"></div>' + 
                        '</div>' + 
                    '</div>' + 
                '</div>' + 
                '</div>';
        var backdrop = '<div class="modal-backdrop show qr_alert_modal"  style="display: block;z-index:9998"></div>';

        $(html).appendTo(document.body);
        $(backdrop).appendTo(document.body);
        $(document.body).addClass("modal-open");
    });

    $(document.body).on('click','.qr_alert_modal [data-dismiss="modal"]', function(){

        $(document.body).removeClass("modal-open");
        $(".qr_alert_modal").remove();

    });


    
});
</script>
</header>