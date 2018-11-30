<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
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
<link rel="shortcut icon" href="{{asset('img/logo_48.ico')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{asset('css/reset.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{asset('css/cmn.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@yield('styles')
<script src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
<script src="{{asset('js/jquery.cookie.js')}}"></script>
<script src="{{asset('js/jquery.bxslider.min.js')}}"></script>
<script src="{{asset('js/underscore.js')}}"></script>
<script src="{{asset('js/velocity.min.js')}}"></script>
</head>
<body id="top">
<div id="wrapper">
    {{-- ヘッダ --}}
    @yield('header')
    {{-- スライドショー --}}
    @yield('bxslider')
    {{-- パス --}}
    @yield('path')
    {{-- コンテンツ --}}
    @yield('content')
    {{-- フッダ --}}
    @include('parts.footer')
</div><!-- /wrapper -->
@yield('scripts')
</body>
</html>