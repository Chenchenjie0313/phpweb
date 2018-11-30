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
<link rel="stylesheet" type="text/css" href="<?= View::css('support.css'); ?>" media="all">

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
  <?php /** コンテンツ  */ ?>
  <?php View::view('parts/access'); ?>
  <?php /** フッダ  */ ?>
  <?php View::view('parts/footer'); ?>
</div><!-- /wrapper -->
</body>
</html>