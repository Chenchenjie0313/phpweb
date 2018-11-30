<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <?php /** 在iPhone的浏览器中页面将以原始大小显示，不允许缩放 */ ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <?php /** 手机号码不被显示为拨号链接 */ ?>
  <meta name="format-detection" content="telephone=no"/>
  <?php /** 开启对web app程序的支持 默认值为default（白色），可以定为black（黑色）和black-translucent（灰色半透明） */ ?>
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-capable" content="yes">

  <title>Top</title>
  <link rel="stylesheet" type="text/css" href="<?= View::css('font-awesome.min.css'); ?>" media="all">
  <link rel="stylesheet" type="text/css" href="<?= View::css('bootstrap.css'); ?>" media="all">
  <link rel="stylesheet" type="text/css" href="<?= View::css('style.css'); ?>" media="all">
  <script src="<?= View::js('require.js'); ?>"></script>
  
</head>

<body class="classic">
<div class="wrapper">
  <nav class="wrapper-head navbar navbar-expand border-bottom" id="navView">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-modalid="leftMenuView" data-is_modal_html="true" data-cache="true" data-url="/templete/lefMenu.txt" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <a href="javascript:void(0);" class="nav-link" data-pageid="homeView" href="javascript:void(0);">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:void(0);" class="nav-link" data-pageid='foodMenuList' data-url="/templete/footMenuList.txt" data-data-type="HTML" >料理</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:void(0);" class="nav-link" data-pageid='noticeList' data-url="/?action=show&method=templeteList&dataType=html">お知らせ</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:void(0);" class="nav-link" >ロコミ</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:void(0);" class="nav-link" >地図</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:void(0);" class="nav-link" data-pageid='help' data-url="/templete/help.txt" data-data-type="HTML" >ヘルプ</a>
      </li>
    </ul>
  </nav>

  <div class="wrapper-content">
    <div class="content">
      <div class="container-fluid wrapper-container">
        <div class="row" id="homeView">
          <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <?php App::include('/html/components/mainHomeCard.php') ?>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="col-md-12">
                  <?php App::include('/html/components/subHomeCard.php') ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php App::include('/html/components/footer.php') ?>
  <?php App::include('/html/components/dialogTemplete.php') ?>
  <?php App::include('/html/components/modalBar.php') ?>


</div>


<script>

var indexHtmlJsonData = <?= Utils::APP_CONFIG_JSON_DATA($token); ?>;

</script>
<script src="/js/core.js?<?=  time() ?>"></script>
</body>
</html>