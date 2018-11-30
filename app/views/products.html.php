<!DOCTYPE html>
<html lang="jp" dir="ltr">
<head prefix="og: http://ogp.me/ns# website: http://ogp.me/ns/website#">
<meta charset="UTF-8">
<title>三一株式会社</title>
<meta name="description" content="三一株式会社のWebサイトです。" />
<meta name="keywords" content="三一,販売事業,車" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=10.0, user-scalable=yes">
<meta name="format-detection" content="telephone=no">
<meta property="og:site_name" content="三一株式会社">
<meta property="og:title" content="">
<meta property="og:type" content="website" />
<meta property="og:description" content="三一株式会社のWebサイトです。">
<meta name="twitter:card" content="summary" />
<link rel="shortcut icon" href="<?= View::img('logo_48.ico'); ?>">
<link rel="stylesheet" type="text/css" href="<?= View::css('bootstrap.css'); ?>" media="all">
<link rel="stylesheet" type="text/css" href="<?= View::css('reset.css'); ?>" media="all">
<link rel="stylesheet" type="text/css" href="<?= View::css('cmn.css'); ?>" media="all">
<link rel="stylesheet" type="text/css" href="<?= View::css('font-awesome.min.css'); ?>" media="all">
<link rel="stylesheet" type="text/css" href="<?= View::css('top.css'); ?>" media="all">

<script src="<?= View::js('jquery-1.11.3.min.js'); ?>"></script>
<script src="<?= View::js('jquery.cookie.js'); ?>"></script>
<script src="<?= View::js('jquery.bxslider.min.js'); ?>"></script>
<script src="<?= View::js('underscore.js'); ?>"></script>
<script src="<?= View::js('velocity.min.js'); ?>"></script>
</head>
<body id="top">
<div id="wrapper">
  <?php /** ヘッダ  */ ?>
  <?php View::view('parts/header'); ?>

  <?php /** --------------------------------------------------------------------------------------  */ ?>
  <ul class="bxslider" id="bxslider">
    <li>
      <div id="mainimg" class="mainimg07" style="background-image: url(<?= View::img('new_car_001.jpg'); ?>);">
        <a href="javascript:void(0);">
          <img src="<?= View::img('pixel.gif'); ?>" alt="ベントレー（Bentley ）4.0V8S" />
        </a>
        <div class="linkbtn_block">
          <a href="javascript:void(0);" class="linkbtn">
            <span id="linkbtn_link_01">
              <div>新車入庫<br/>ベントレー（Bentley ）4.0V8S</div><!--
              <img src="/public/img/arrow.png" class="arrow" alt="" />-->
            </span>
          </a>
        </div>
      </div>
    </li>
    
    <li>
      <div id="mainimg" class="mainimg05" style="background-image: url(<?= View::img('new_car_005.jpg'); ?>);">
        <a href="javascript:void(0);">
          <img src="<?= View::img('pixel.gif'); ?>" alt="ベントレー（Bentley ）" />
        </a>
        <div class="linkbtn_block">
          <a href="/mirai/05_platform/index.html" class="linkbtn">
            <span id="linkbtn_link_02">
              <div>新車入庫<br/>ベントレー（Bentley ）4.0V8S</div><!--
              <img src="/public/img/arrow.png" class="arrow" alt="" />-->
            </span>
          </a>
        </div>
      </div>
    </li>
    
    <li>
      <div id="mainimg" class="mainimg06" style="background-image: url(<?= View::img('new_car_008.jpg'); ?>);">
        <a href="javascript:void(0);">
          <img src="<?= View::img('pixel.gif'); ?>" alt="信用を重んじ 確実を旨とする" />
        </a>
        <div class="linkbtn_block">
          <a href="/mirai/05_platform/index.html" class="linkbtn">
            <span id="linkbtn_link_03">
              <div>新車入庫<br/>ベントレー（Bentley ）4.0V8S</div><!--
              <img src="/public/img/arrow.png" class="arrow" alt="" />-->
            </span>
          </a>
        </div>
      </div>
    </li>

</ul>

<style>

#linkbtn_link_01:after {
content: "ベントレー";
white-space: pre;
}
#linkbtn_link_02:after {
content: "快適性";
white-space: pre;
}
#linkbtn_link_03:after {
content: "高級";
white-space: pre;
}

</style>
<script type="text/javascript">
  var w = $(window).width();
  var x = 767;
  if (w > x) {
    $(document).ready(function(){$('#bxslider').bxSlider({auto:true,adaptiveHeight:true,pause:5000,randomStart:false});});
  }
  else if (w <= x) {
    $(document).ready(function(){$('#bxslider').bxSlider({mode:'fade', auto:true,adaptiveHeight:true,pause:8000,randomStart:false});});
  }




</script>





  <?php /** コンテンツ  */ ?>
  <?php View::view('parts/productAll'); ?>
  <?php View::view('parts/showImgs'); ?>
  <?php /** フッダ  */ ?>
  <?php View::view('parts/footer'); ?>
</div><!-- /wrapper -->
</body>
</html>