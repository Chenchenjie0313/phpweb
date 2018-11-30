<header id="header">
<div id="headerIn">
<div id="headerLogo"><a href="<?= View::url('/'); ?>"><img src="<?= View::img('logo.png'); ?>" alt="三一株式会社" style="width:32px;height:32px;"></a><span>三一株式会社</span></div>
</div>
<div id="gNaviWrap">
<div class="toggle" id="header_open_btn"></div>
<nav id="gNavi">
  <ul id="mNavi">
    <li class="mNav01"><a href="<?= View::url('/'); ?>">ホーム</a></li>
    <li class="mNav02"><a href="<?= View::url('products'); ?>">製品・サービス</a></li>
    <li class="mNav03"><a href="<?= View::url('news'); ?>">イベント・ニュース</a></li>
    <li class="mNav04"><a href="<?= View::url('about'); ?>">企業情報</a>
      <ul>
        <li><a href="<?= View::url('access'); ?>">会社概要</a></li>
        <li><a href="<?= View::url('access'); ?>">事業内容</a></li>
        <li><a href="<?= View::url('access'); ?>">経営方針</a></li>
      </ul>
    </li>
    <li class="mNav05"><a href="<?= View::url('access'); ?>">採用情報</a></li>
    <li class="mNav06"><a href="<?= View::url('inquiry'); ?>">お問い合わせ</a></li>
    <li class="mNav07"><a href="<?= View::url('access'); ?>">所在地・アクセス</a></li>
  </ul>

  <ul id="fNavi">
  <li class="fNav03"><a href="<?= View::url('access'); ?>" >所在地・アクセス</a></li>
  <li class="fNav02"><a href="<?= View::url('access'); ?>" >お問い合わせ</a></li>
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
});
</script>
</header>