/**
 * common.js
 *
 */





//menu ADD 20160704  サブメニューが追加されたことにより、ソースを見直しました。
$(function() {
	var $menu= $('#gNavi');
	var $submenubtn= $('#categoryVisual');
	var $submenu= $('#localNavi');
	$('.toggle').on('click', function(){
		$menu.toggleClass('open');
	});
	$submenubtn.click(function(){
		if($submenubtn.css('background-image').indexOf('icn') != -1){
			$submenubtn.toggleClass('open');
			$submenu.toggleClass('open');
			var headerHeight = $('#header').outerHeight();
			var categoryVisualHeight = $submenubtn.outerHeight();
			var localNaviTop = headerHeight + categoryVisualHeight;
			$submenu.css('top',localNaviTop);
		}
	});
	$('#localNavi a').click(function(){ //クリックするとメニューを閉じる（ページ内リンク対策）ADD 20160824 
		$submenubtn.removeClass('open');
		$submenu.removeClass('open');
	});
});

//smoothScroll
$(function(){
	$('a[href^=#wrapper]').click(function(){
 	var speed = 500;
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$("html, body").animate({scrollTop:position}, speed, "swing");
		return false;
	});
	$('a[href^=#inquiry]').click(function(){ // ADD 20160607
 	var headerHight = 125; //ヘッダの高さ
		var speed = 500;
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top-headerHight; //ヘッダの高さ分位置をずらす
		$("html, body").animate({scrollTop:position}, speed, "swing");
		return false;
	});
});


//$(function(){ // 	ページ内＃リンク対応
$(window).load(function() {
// 
// 20170411 aタグの name属性をid属性に付け替える処理
//
	//古いソースでページTOPへでidではなくnameを使っている箇所があるため
//	$("a[name=upper]").attr("id", "upper");
//	$("a[name=contactdetail]").attr("id", "contactdetail");
	$("a[name]:not(a[href])").each(function() {
		var name_value= $(this).attr("name");
//		console.log("name_value=" + name_value);
		$(this).attr('id',name_value);
	});

   var zm = $('#main_contents').css('zoom');   
   var common_old = $("#main_contents").css('z-index');  // product/css/common_old.css を読み込んでいる場合は "2"が返ります 
   var new_template = $("#category-Index-contents").css('z-index');  //  新テンプレートの判定　"2"が返ります

	if($('#main_contents2').length){  //  main_contents2の判定　"3"が返ります
		new_template = 3;
	}
//	console.log("new_template=" + new_template);


/*ページ内＃リンク*/
  $('[href^=#]:not(.notChangeId)').click(function(){
  var href= $(this).attr("href");
  var target = $(href == "#" || href == "" ? 'body' : href);

//   var w = $(window).width();
   var w = window.innerWidth;
   if (w >=767 ) {
   var headerHight =125; //PC版 ヘッダの高さ
   } else {
   var headerHight =60; //SP版 ヘッダの高さ
   }


if(!new_template){
// 20170425 Native JavaScript で offsetTop を取得
  var elem = target.get(0);
  var lastTop = 0;
  do {
    lastTop += elem.offsetTop;
    elem = elem.offsetParent;
  } while (elem !== null);
  var njTargetOffsetTop = lastTop;


var target1positon = 0;
if (w <= 435 ) {  //ウィンドウ幅に応じて位置調整
  target1positon = njTargetOffsetTop;
}else{
  target1positon = target.offset().top-headerHight; //ヘッダの高さ分位置をずらす
}

}else{
var target1positon = target.offset().top-headerHight;
//console.log("target.offset().top=" + target1positon);
}

//console.log("target=" + target);
//console.log("target.offset().top=" + target.offset().top);
//console.log("njTargetOffsetTop=" + njTargetOffsetTop);
//console.log("headerHight=" + headerHight);
//console.log("target1positon=" + target1positon);
//console.log("bigfix=" + $('#bigfix').get(0).offsetTop);
//console.log("qradar=" + $('#qradar').get(0).offsetTop);

if(!new_template){
  if (w <= 320 ) {  //ウィンドウ幅に応じて位置調整
     if(new_template==2){ 
     var position = target1positon;
     } else {  
     var position = (target1positon * 0.4) -60;


     }
   } else if(w <= 380 ) {
     if(new_template==2){ 
     var position = target1positon;
     } else {  
     var position = (target1positon * 0.48) -60;
     }
   } else if(w <= 414 ) {
     if(new_template==2){ 
     var position = target1positon;
     } else {  
//     var position = (target1positon * 0.54) -50;
     var position = (target1positon * 0.54)-80;
     }
   } else if(w <= 435 ) {
     if(new_template==2){ 
     var position = target1positon;
     } else {  
     var position = (target1positon * 0.57) -40;
     }
   } else if(w <= 570 ) {
     if(new_template==2){ 
     var position = target1positon;
     } else {  
     var position = (target1positon * 0.8) -20;
     }
   } else if(w <= 640 ) {
     if(new_template==2){ 
     var position = target1positon;
     } else {  
     var position = (target1positon * 0.9) -10;
     } 
   } else if(w <= 767 ) {
     if(new_template==2){ 
     var position = target1positon;
     } else {  
     var position = (target1positon * 0.95) ;
     }   
   } else  { 
      var position = target1positon;
  }
}else{
//	console.log('新テンプレート');
	var position = target1positon;
}




//var position = target1positon;
//console.log('position:'+position);

//  console.log('--通常ページ内＃リンク--');
  $("html, body").animate({scrollTop:position}, 500, "swing");
  });



	/*ページ外＃リンク*/
	var url = $(location).attr('href');
	if (url.indexOf("?id=") == -1) {
	}else{

//   var w = $(window).width();
   var w = window.innerWidth;
   if (w >=767 ) {
   var headerHight =125; //PC版 ヘッダの高さ
   } else {
   var headerHight =110; //SP版 ヘッダの高さ
   }


   var url_sp = url.split("?id=");
   var hash = "#" + url_sp[url_sp.length - 1];
   var target2 = $(hash);
   var target2positon = $(target2).get(0).offsetTop-headerHight;

//console.log('target2positon 調整前:'+target2positon);

// 20170425 Native JavaScript で offsetTop を取得
// 20170815 -80以下に調整
if(target2positon < -80 ){
	
  var elem = target2.get(0);
  var lastTop = 0;
  do {
    lastTop += elem.offsetTop;
    elem = elem.offsetParent;
  } while (elem !== null);
  var njTargetOffsetTop = lastTop;


	var target2positon = 0;
	if (w <= 435 ) {  //ウィンドウ幅に応じて位置調整
	  target2positon = njTargetOffsetTop-200;
	} else if(w <= 570 ) {
	  target2positon = njTargetOffsetTop-250;
   } else if(w <= 767 ) {
	  target2positon = njTargetOffsetTop-140;
	} else {
		target2positon = target2.offset().top-headerHight -160; //ヘッダの高さ分位置をずらす
//		console.log('target2positon とりかた変更:'+target2positon);
	}

// 20170815 マイナスの場合に微調整
}else if(target2positon < 0 ){
	//	console.log("マイナスの調整");
	target2positon -= 20;
}else{

//	console.log("調整");

}

//console.log('target2positon 調整後:'+target2positon);

if(!new_template){
	
   if (w <= 320 ) {  //ウィンドウ幅に応じて位置調整
     if(common_old==2){ 
     var position2 = (target2positon * 0.52)+60;
     } else if(new_template==2){
      var position2 = target2positon+220;
     } else {
     var position2 = (target2positon * 0.4) ;
     }
   } else if(w <= 380 ) {
     if(common_old==2){ 
     var position2 = (target2positon * 0.65) +60;
     } else if(new_template==2){
      var position2 = target2positon+230;
     } else {
     var position2 = (target2positon * 0.48) ;
     }    
   } else if(w <= 414 ) {
     if(common_old==2){ 
     var position2 = (target2positon * 0.68) +60;
     } else if(new_template==2){
      var position2 = target2positon+250;
     } else {
//     var position2 = (target2positon * 0.57) ;
     var position2 = (target2positon * 0.54) ;

     }
   } else if(w <= 435 ) {
     if(common_old==2){ 
     var position2 = (target2positon * 0.73)+75 ;
     } else if(new_template==2){
      var position2 = target2positon+260;
     } else {
     var position2 = (target2positon * 0.57) ;
     }
   } else if(w <= 570 ) {
    if(new_template==2){
     var position2 = target2positon+270;
     } else {
     var position2 = (target2positon * 0.8) +75;
     }
   } else if(w <= 640 ) {
    if(new_template==2){
     var position2 = target2positon+280;
     } else {
     var position2 = (target2positon * 0.9) ;
     }
   } else if(w <= 767 ) {
     if(new_template==2){
     var position2 = target2positon+290;
     } else {
     var position2 = (target2positon * 0.95) ;
     }
   } else  { 
      if(common_old==2){ 
      var position2 = target2positon+300;
      } else if(new_template==2){
      var position2 = target2positon+300;
      } else {
      var position2 = target2positon+160;
      }
    }
}else{
//	console.log('新テンプレート');
	if(w <= 767 ) {
		var position2 = target2positon+95;
	}else{
		var position2 = target2positon+160;
	}
}
//console.log('position2:'+position2);
//console.log('--ページ外＃リンク--');
		$("html, body").animate({scrollTop:position2}, 500, "swing");
  
		}

//console.log('width:'+w);
//console.log('common_old:'+common_old);
//console.log('zoom:'+zm);
//console.log('new_template:'+new_template);


});


$(function(){
	$(".pageTop").hide();
	$("#submenuLink").hide();
	
	
	$(window).bind("scroll", function() {
	var scrollHeight = $(document).height();
	var scrollPosition = $(window).height() + $(window).scrollTop();
	var footHeight = $("footer").height();
	if ($(this).scrollTop() > 350) { 
		$(".pageTop").fadeIn();
		$("#submenuLink").fadeIn();
		$("#submenuLink").addClass('follow');
	} else {
		$(".pageTop").fadeOut();
		$("#submenuLink").fadeOut();
		$("#submenuLink").removeClass('follow');
		// サブメニューが表示されていた場合、非表示にする（この基準位置は別に設定したほうがよいかもしれないので確認する）
		$('#submenu-f').removeClass('submenu-f-fadeIn');
	}
	if ( scrollHeight - scrollPosition  <= footHeight ) {
		$(".pageTop a").css({"opacity":"1","position":"absolute","bottom": "-20px"});
	} else {
		$(".pageTop a").css({"opacity":"0.8","position":"fixed","bottom": "10px"});
	}
	// 20180719 製品・サービス「お問い合わせはこちら」制御追加
	if ( scrollHeight - scrollPosition  <= footHeight+200 ) {
		$("#inquiryLink").fadeOut();
//		console.log("#inquiryLink fadeOut");
	} else {
		$("#inquiryLink").fadeIn();
	}

	});
	
});


// 20160215 CAMP臨時対応 hrefに http://www.camp-k.com/ が含まれる場合、http://www.camp-k.com/にする
//$(document).ready(function() {
//$('a[href^="http://www.camp-k.com/"]').attr("href", "http://www.camp-k.com/")
//});

// 20160420 PDFアイコンのスマホ対応
$(window).on('load resize', function(){
//var wid = $(window).width();
var wid = window.innerWidth;

//	console.log("wid=" + wid);
	if( wid < 767 ){ // ウィンドウ幅が767px未満だったら
//		console.log("wid=" + wid + " sp");
		$("img[src*='/img/icn/icn_pdf.gif']").each(function(){
			$(this).attr("src",$(this).attr("src").replace('icn_pdf', 'sp_icn_pdf'));
			$(this).addClass("sp_icn_pdf");
		});

		$("a.sp_disable").attr("href", "javascript:none;")


	}else{
		$("img[src*='/img/icn/sp_icn_pdf.gif']").each(function(){
			$(this).attr("src",$(this).attr("src").replace('sp_icn_pdf', 'icn_pdf'));
			$(this).removeClass("sp_icn_pdf");
		});
	}
});

//画像はみ出し対応：新規
$(function(){
		$(window).on('load resize',function(){
//			var scrollWidth = $(window).width();
			var scrollWidth = window.innerWidth;
			$('.scroll').css('width',scrollWidth*0.95); // 20180226 95%に
			// 20170804
			if( scrollWidth < 767 ){ // ウィンドウ幅が767px未満だったら
				$('.section_scroll').css('width',scrollWidth);
			}
			// 20170518 PC表示時もスクロールさせたい場合のclass追加
			var scrollWidthPC = scrollWidth;
			if(scrollWidth > 767){
				scrollWidthPC = 740;
			}
			$('.scroll-pc').css('width',scrollWidthPC);
		});
});

//ページ追従処理
$(function(){
	var ds = 0;
	var bt = 140;	// お問い合わせはこちらを表示する値
	var bm = 500;	// サブメニューをを表示する値

			$(document).scroll(function(){
				ds = $(this).scrollTop();
				if (bt <= ds) {
					$("#inquiryLink").addClass('follow');
				} else if (bt >= ds) {
					$("#inquiryLink").removeClass('follow');
				}
/*
				if (bm <= ds) {
					$("#submenuLink").addClass('follow');
				} else if (bm >= ds) {
					$("#submenuLink").removeClass('follow');
				}
*/
			});
});

//ヘッダー縮小 処理
$(function(){
	var px_change  = 0;
			$(document).scroll(function(){
				if ( $(window).scrollTop() > px_change ) {
						$("header").addClass("smaller");
						$("#categoryVisual").addClass("smaller");
						$("#main_contents2").addClass("smaller");
						} else if ( $("header").hasClass("smaller") ) {
						$("header").removeClass("smaller");
						$("#categoryVisual").removeClass("smaller");
						$("#main_contents2").removeClass("smaller");
				}
			});
});

// リンク先の書き換え ADD 20160824
$(document).ready(function() {
	//ページTOPリンク
	$(".pageTop a").attr("href", "#wrapper");
	//ページ外リンク		
	$("a[href]").each(function() {
		if(this.className == "boxer") { //  boxerというclass がある場合は変換しない
		 } else if(this.className == "notChangeId") { //  または、notChangeIdというclass がある場合は変換しない
		 } else if($(this).attr('href').indexOf('http') != -1 || $(this).attr('href').indexOf('/sp/') == 0 || $(this).attr('href').indexOf('/opencms/sp/') == 0) { // 20170720
		 	 // http が含まれている または /sp/ から始まる
		 	 //console.log("リンク置換除外 " + $(this).attr('href'));
		 } else {
			var replace = null;
			var replace = $(this).attr('href').replace(/.html#/g,'.html?id=');
//			console.log("replace=" + replace);
				$(this).attr('href',replace);
		}
	});
});


$(function(){
	if(CheckTest()){
		if($("#WebEntry1").length){
			var repUrl = null;
			repUrl = $("#WebEntry1").attr('href').replace(secUrl,secUrlStaging);
			$("#WebEntry1").attr('href',repUrl);
//			console.log("repUrl1: " + repUrl);
			repUrl = $("#WebEntry2").attr('href').replace(secUrl,secUrlStaging);
			$("#WebEntry2").attr('href',repUrl);
//			console.log("repUrl2: " + repUrl);
		}
		$("a[href^='" + secUrl + "'").each(function() { 
			var repUrl = null;
			repUrl = $(this).attr('href').replace(secUrl,secUrlStaging);
//			console.log("変更前：" + $(this).attr('href') + "\n" + "変更後：" + repUrl);
			$(this).attr('href',repUrl);
		});
		$("a[href^='" + authUrl + "'").each(function() { // 20170824 auth を追加
			var repUrl = null;
			repUrl = $(this).attr('href').replace(authUrl,authUrlStaging);
//			console.log("変更前：" + $(this).attr('href') + "\n" + "変更後：" + repUrl);
			$(this).attr('href',repUrl);
		});
		$("a[href*='" + spUrlcms + "'").each(function() { // 20171005 sp を追加
			var repUrl = null;
			repUrl = $(this).attr('href').replace(opencmsPref,'');
			repUrl = repUrl.replace(spUrlcms,spUrlStaging);
//			console.log("変更前：" + $(this).attr('href') + "\n" + "変更後：" + repUrl);
			$(this).attr('href',repUrl);
		});
		$("a[href*='" + libUrlcms + "'").each(function() { // 20171005 lib を追加
			var repUrl = null;
			repUrl = $(this).attr('href').replace(opencmsPref,'');
			repUrl = repUrl.replace(libUrlcms,libUrlStaging);
//			console.log("変更前：" + $(this).attr('href') + "\n" + "変更後：" + repUrl);
			$(this).attr('href',repUrl);
		});
	}
});


// CMS環境かどうかのチェック
function CheckTest() {
var hostname = window.location.hostname;
var TESTHOST = "grpap006";
//var TESTHOST = "staging-";
//console.log("hostname: " + hostname);
	if(hostname.indexOf(TESTHOST) !=-1 ){
		return true;
	}else{
		return false;
	}
}


/*
 XDate v0.8
 Docs & Licensing: http://arshaw.com/xdate/
*/
var XDate=function(g,n,A,p){function f(){var a=this instanceof f?this:new f,c=arguments,b=c.length,d;typeof c[b-1]=="boolean"&&(d=c[--b],c=q(c,0,b));if(b)if(b==1)if(b=c[0],b instanceof g||typeof b=="number")a[0]=new g(+b);else if(b instanceof f){var c=a,h=new g(+b[0]);if(l(b))h.toString=v;c[0]=h}else{if(typeof b=="string"){a[0]=new g(0);a:{for(var c=b,b=d||!1,h=f.parsers,w=0,e;w<h.length;w++)if(e=h[w](c,b,a)){a=e;break a}a[0]=new g(c)}}}else a[0]=new g(m.apply(g,c)),d||(a[0]=r(a[0]));else a[0]=new g;
typeof d=="boolean"&&B(a,d);return a}function l(a){return a[0].toString===v}function B(a,c,b){if(c){if(!l(a))b&&(a[0]=new g(m(a[0].getFullYear(),a[0].getMonth(),a[0].getDate(),a[0].getHours(),a[0].getMinutes(),a[0].getSeconds(),a[0].getMilliseconds()))),a[0].toString=v}else l(a)&&(a[0]=b?r(a[0]):new g(+a[0]));return a}function C(a,c,b,d,h){var e=k(j,a[0],h),a=k(D,a[0],h),h=!1;d.length==2&&typeof d[1]=="boolean"&&(h=d[1],d=[b]);b=c==1?(b%12+12)%12:e(1);a(c,d);h&&e(1)!=b&&(a(1,[e(1)-1]),a(2,[E(e(0),
e(1))]))}function F(a,c,b,d){var b=Number(b),h=n.floor(b);a["set"+o[c]](a["get"+o[c]]()+h,d||!1);h!=b&&c<6&&F(a,c+1,(b-h)*G[c],d)}function H(a,c,b){var a=a.clone().setUTCMode(!0,!0),c=f(c).setUTCMode(!0,!0),d=0;if(b==0||b==1){for(var h=6;h>=b;h--)d/=G[h],d+=j(c,!1,h)-j(a,!1,h);b==1&&(d+=(c.getFullYear()-a.getFullYear())*12)}else b==2?(b=a.toDate().setUTCHours(0,0,0,0),d=c.toDate().setUTCHours(0,0,0,0),d=n.round((d-b)/864E5)+(c-d-(a-b))/864E5):d=(c-a)/[36E5,6E4,1E3,1][b-3];return d}function s(a){var c=
a(0),b=a(1),d=a(2),a=new g(m(c,b,d)),c=t(I(c,b,d));return n.floor(n.round((a-c)/864E5)/7)+1}function I(a,c,b){c=new g(m(a,c,b));if(c<t(a))return a-1;else if(c>=t(a+1))return a+1;return a}function t(a){a=new g(m(a,0,4));a.setUTCDate(a.getUTCDate()-(a.getUTCDay()+6)%7);return a}function J(a,c,b,d){var h=k(j,a,d),e=k(D,a,d);b===p&&(b=I(h(0),h(1),h(2)));b=t(b);d||(b=r(b));a.setTime(+b);e(2,[h(2)+(c-1)*7])}function K(a,c,b,d,h){var e=f.locales,g=e[f.defaultLocale]||{},i=k(j,a,h),b=(typeof b=="string"?
e[b]:b)||{};return x(a,c,function(a){if(d)for(var b=(a==7?2:a)-1;b>=0;b--)d.push(i(b));return i(a)},function(a){return b[a]||g[a]},h)}function x(a,c,b,d,e){for(var f,g,i="";f=c.match(N);){i+=c.substr(0,f.index);if(f[1]){g=i;for(var i=a,j=f[1],l=b,m=d,n=e,k=j.length,o=void 0,q="";k>0;)o=O(i,j.substr(0,k),l,m,n),o!==p?(q+=o,j=j.substr(k),k=j.length):k--;i=g+(q+j)}else f[3]?(g=x(a,f[4],b,d,e),parseInt(g.replace(/\D/g,""),10)&&(i+=g)):i+=f[7]||"'";c=c.substr(f.index+f[0].length)}return i+c}function O(a,
c,b,d,e){var g=f.formatters[c];if(typeof g=="string")return x(a,g,b,d,e);else if(typeof g=="function")return g(a,e||!1,d);switch(c){case "fff":return i(b(6),3);case "s":return b(5);case "ss":return i(b(5));case "m":return b(4);case "mm":return i(b(4));case "h":return b(3)%12||12;case "hh":return i(b(3)%12||12);case "H":return b(3);case "HH":return i(b(3));case "d":return b(2);case "dd":return i(b(2));case "ddd":return d("dayNamesShort")[b(7)]||"";case "dddd":return d("dayNames")[b(7)]||"";case "M":return b(1)+
1;case "MM":return i(b(1)+1);case "MMM":return d("monthNamesShort")[b(1)]||"";case "MMMM":return d("monthNames")[b(1)]||"";case "yy":return(b(0)+"").substring(2);case "yyyy":return b(0);case "t":return u(b,d).substr(0,1).toLowerCase();case "tt":return u(b,d).toLowerCase();case "T":return u(b,d).substr(0,1);case "TT":return u(b,d);case "z":case "zz":case "zzz":return e?c="Z":(d=a.getTimezoneOffset(),a=d<0?"+":"-",b=n.floor(n.abs(d)/60),d=n.abs(d)%60,e=b,c=="zz"?e=i(b):c=="zzz"&&(e=i(b)+":"+i(d)),c=
a+e),c;case "w":return s(b);case "ww":return i(s(b));case "S":return c=b(2),c>10&&c<20?"th":["st","nd","rd"][c%10-1]||"th"}}function u(a,c){return a(3)<12?c("amDesignator"):c("pmDesignator")}function y(a){return!isNaN(+a[0])}function j(a,c,b){return a["get"+(c?"UTC":"")+o[b]]()}function D(a,c,b,d){a["set"+(c?"UTC":"")+o[b]].apply(a,d)}function r(a){return new g(a.getUTCFullYear(),a.getUTCMonth(),a.getUTCDate(),a.getUTCHours(),a.getUTCMinutes(),a.getUTCSeconds(),a.getUTCMilliseconds())}function E(a,
c){return 32-(new g(m(a,c,32))).getUTCDate()}function z(a){return function(){return a.apply(p,[this].concat(q(arguments)))}}function k(a){var c=q(arguments,1);return function(){return a.apply(p,c.concat(q(arguments)))}}function q(a,c,b){return A.prototype.slice.call(a,c||0,b===p?a.length:b)}function L(a,c){for(var b=0;b<a.length;b++)c(a[b],b)}function i(a,c){c=c||2;for(a+="";a.length<c;)a="0"+a;return a}var o="FullYear,Month,Date,Hours,Minutes,Seconds,Milliseconds,Day,Year".split(","),M=["Years",
"Months","Days"],G=[12,31,24,60,60,1E3,1],N=/(([a-zA-Z])\2*)|(\((('.*?'|\(.*?\)|.)*?)\))|('(.*?)')/,m=g.UTC,v=g.prototype.toUTCString,e=f.prototype;e.length=1;e.splice=A.prototype.splice;e.getUTCMode=z(l);e.setUTCMode=z(B);e.getTimezoneOffset=function(){return l(this)?0:this[0].getTimezoneOffset()};L(o,function(a,c){e["get"+a]=function(){return j(this[0],l(this),c)};c!=8&&(e["getUTC"+a]=function(){return j(this[0],!0,c)});c!=7&&(e["set"+a]=function(a){C(this,c,a,arguments,l(this));return this},c!=
8&&(e["setUTC"+a]=function(a){C(this,c,a,arguments,!0);return this},e["add"+(M[c]||a)]=function(a,d){F(this,c,a,d);return this},e["diff"+(M[c]||a)]=function(a){return H(this,a,c)}))});e.getWeek=function(){return s(k(j,this,!1))};e.getUTCWeek=function(){return s(k(j,this,!0))};e.setWeek=function(a,c){J(this,a,c,!1);return this};e.setUTCWeek=function(a,c){J(this,a,c,!0);return this};e.addWeeks=function(a){return this.addDays(Number(a)*7)};e.diffWeeks=function(a){return H(this,a,2)/7};f.parsers=[function(a,
c,b){if(a=a.match(/^(\d{4})(-(\d{2})(-(\d{2})([T ](\d{2}):(\d{2})(:(\d{2})(\.(\d+))?)?(Z|(([-+])(\d{2})(:?(\d{2}))?))?)?)?)?$/)){var d=new g(m(a[1],a[3]?a[3]-1:0,a[5]||1,a[7]||0,a[8]||0,a[10]||0,a[12]?Number("0."+a[12])*1E3:0));a[13]?a[14]&&d.setUTCMinutes(d.getUTCMinutes()+(a[15]=="-"?1:-1)*(Number(a[16])*60+(a[18]?Number(a[18]):0))):c||(d=r(d));return b.setTime(+d)}}];f.parse=function(a){return+f(""+a)};e.toString=function(a,c,b){return a===p||!y(this)?this[0].toString():K(this,a,c,b,l(this))};
e.toUTCString=e.toGMTString=function(a,c,b){return a===p||!y(this)?this[0].toUTCString():K(this,a,c,b,!0)};e.toISOString=function(){return this.toUTCString("yyyy-MM-dd'T'HH:mm:ss(.fff)zzz")};f.defaultLocale="";f.locales={"":{monthNames:"January,February,March,April,May,June,July,August,September,October,November,December".split(","),monthNamesShort:"Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec".split(","),dayNames:"Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday".split(","),dayNamesShort:"Sun,Mon,Tue,Wed,Thu,Fri,Sat".split(","),
amDesignator:"AM",pmDesignator:"PM"}};f.formatters={i:"yyyy-MM-dd'T'HH:mm:ss(.fff)",u:"yyyy-MM-dd'T'HH:mm:ss(.fff)zzz"};L("getTime,valueOf,toDateString,toTimeString,toLocaleString,toLocaleDateString,toLocaleTimeString,toJSON".split(","),function(a){e[a]=function(){return this[0][a]()}});e.setTime=function(a){this[0].setTime(a);return this};e.valid=z(y);e.clone=function(){return new f(this)};e.clearTime=function(){return this.setHours(0,0,0,0)};e.toDate=function(){return new g(+this[0])};f.now=function(){return+new g};
f.today=function(){return(new f).clearTime()};f.UTC=m;f.getDaysInMonth=E;if(typeof module!=="undefined"&&module.exports)module.exports=f;typeof define==="function"&&define.amd&&define([],function(){return f});return f}(Date,Math,Array);



// // セミナー締切処理
// var strDefaultCtxtPre = '<p class="limitOverMessage"><span class="over_red">';
// var strDefaultCtxt = '申し訳ございませんが、本セミナーのお申し込みは、終了させていただきました。';
// var strDefaultCtxtSuf = '</span></p>';
// var limitOverIconTag = '<i class="icn3 icn-full">申込締切</i>'



// function CheckLimit() {
// var strLimitDate = "";
// var LimitDateAry = "";
// var limitOverMessageTag = "";

// 	// 開催日の要素
// 	$("a#WebEntry1[data-limit]").each(function() {
// 		LimitDateAry = formatLimitDate($(this).attr('data-limit'));
// 		// フォーマットチェックでtrueならば処理
// 		if(LimitDateAry[1]){
// 			// 締切チェック
// 			if(CompareDate(LimitDateAry[0])){
// //				console.log("締切");
// 				var ctxt = $(this).attr('data-ctxt');
// 				// カスタム文言があった場合は、それを使う
// 				if(ctxt != undefined && ctxt.length > 0) {
// 					limitOverMessageTag = strDefaultCtxtPre + ctxt + strDefaultCtxtSuf;
// 				}else{
// 					limitOverMessageTag = strDefaultCtxtPre + strDefaultCtxt + strDefaultCtxtSuf;
// 				}
// //				$("a#WebEntry1").parent('div').append(limitOverMessageTag);
// 				$("div.day").append(limitOverIconTag);
// 				$("dl.press_detail").append(limitOverMessageTag);
// 				$("a#WebEntry1").hide();
// 				$("a#WebEntry2").hide();
// 				$(".WebEntryComment").hide();
// 				$(".FaxDownload").hide();
// 				// 20180524 新テンプレート用
// 				$("p.day").append(limitOverIconTag);
// 				$("section.WebEntry").append(limitOverMessageTag);
// 				$("div.WebEntry").hide();
// 			}else{
// //				console.log("有効");
// 			}
// 		}else{
// 			if(CheckTest()){
// 				alert("型エラー:LimitDateAry[0]=" + LimitDateAry[0]);
// 			}
// 		}

// 	});
// }

// セミナー締切処理：日付比較
// function CompareDate(strLimitDate) {
// var resultFlg = false;
// var today = new XDate(); // 現在日時
// var dummyToday = "";
// var limitTime = new XDate(strLimitDate); // 現在日時と比較する期限日時
// 	if(CheckTest()){ // 以下はテスト環境のみ、テスト用にクッキーを使用
// 		dummyToday = $.cookie('dummyToday');
// 		console.log("dummyToday=" + dummyToday);
// 		if (dummyToday != undefined ) {
// 			today = new XDate(dummyToday);
// 		}else{
// 			// クッキーがなければ現在日時で作成
// 			$.cookie('dummyToday', today.toString("i"), { 
// 			path:'/' 
// 			});
// 		}
// 		console.log("today=" + today.toString("yyyy/MM/dd HH:mm:ss"));
// 		console.log("limitTime=" + limitTime.toString("yyyy/MM/dd HH:mm:ss"));
// 	}

// 	// 現在日時が過ぎていたら
// 	if(limitTime < today){
// 		resultFlg = true;
// 	}
// return resultFlg;
// }

// 日付フォーマットチェック
// function formatLimitDate(strDate){
// var strFormatLimitDate = strDate;
// var checkFlg = false;
// var tmpDateAry = "";

// 	if (strFormatLimitDate != undefined ) {
// 	}else{
// 		strFormatLimitDate = "";
// 	}

// //	console.log("[before]strFormatLimitDate=" + strFormatLimitDate);
// 	strFormatLimitDate = strFormatLimitDate.replace(/\//g,"-");
// 	strFormatLimitDate = strFormatLimitDate.replace(/\s/,"T");
// 	// 型チェック
// 	if(strFormatLimitDate.length == 0 || (strFormatLimitDate.indexOf("T") == 10 && strFormatLimitDate.length == 19)){
// 		checkFlg = true;
// 	}else{
// 		checkFlg = false;
// 	}
// 	tmpDateAry = LimitDateAryConstructor(strFormatLimitDate, checkFlg);
// //	console.log("[after ]tmpDateAry[0]=" + tmpDateAry[0] + " ,tmpDateAry[1]=" + tmpDateAry[1]);
// return tmpDateAry;
// }

// // 締切日付のコンストラクター
// // tmpDateAry[0] = 日付文字列;
// // tmpDateAry[1] = フォーマットチェック結果（デフォルト：false）
// function LimitDateAryConstructor(strDate, checkResultFlg){
// 	var tmpDateAry = new Array();
// 	tmpDateAry[0] = strDate;
// 	tmpDateAry[1] = checkResultFlg;
// return tmpDateAry;
// }






// // リファラー作成処理（？以降カット、1000文字以降カット）
// function getStrRef(strRef){
// //console.log("getStrRef = " + strRef);
// var tmpStr = "";
// 	if(strRef.indexOf("?") != -1){
// 		tmpStr = strRef.substr(0, strRef.indexOf("?"));
// 	}else{
// 		tmpStr = strRef;
// 	}
// 	tmpStr = tmpStr.substr(0,1000);
// 	//console.log("tmpStr = " + tmpStr);
// return tmpStr
// }


// var PATH_OSS = "/product/oss/";
// var PATH_CORP_OUTLINE = "/corp/outline.html";
// var PATH_CORP_OUTLINE_EN = "/corp_en/outline.html";
// var PATH_PRODUCT_COMMON = "/product/common/";
// var PATH_EVENT = "/event/";
// $(document).ready(function() {
// var path = window.location.pathname;
// var qparam = window.location.search;
// // 20170323 OSSへの取り組み　用語集へのリンク削除
// 	if(path.indexOf(PATH_OSS) !=-1 ){
// //		console.log("oss_words");
// 		$('a[href*=oss_words]').attr("href", "javascript:void(0)");
// 	}
// // 20170424 特定のページで、キャッシュ防止のために更新日時でパラメータを付加する
// 	if(path.indexOf(PATH_CORP_OUTLINE) !=-1 || path.indexOf(PATH_CORP_OUTLINE_EN) !=-1 ){
// //		console.log("PATH_CORP_OUTLINE");
// //		var today = new XDate(); // 現在日時
// //		var strToday = today.toString("yyyyMMddHHmmss");
// //		console.log("strToday=" + strToday);
// 		$('a[href$=".pdf"]').each(function(){
// //			$(this).attr("href", $(this).attr("href").replace('.pdf', '.pdf?' + strToday));
// 			$(this).attr("href", $(this).attr("href") + "?date=" + $(this).attr("data-updatedate"));
// 		});
// 		$('img[src*="soshikizu"]').each(function(){
// //			$(this).attr("src", $(this).attr("src").replace('.gif', '.gif?' + strToday));
// 			$(this).attr("src",  $(this).attr("src") + "?date=" + $(this).attr("data-updatedate"));
// 		});
// 	}
// // 20170901 Vimeoのモーダルダイアログ表示をGAイベントに送信
// 	$('a.ga_vimeo').click(function(){
// 		var galabel = $(this).attr('data-galabel');
// //		console.log('vimeo click=' + galabel);
// 		ga('create', 'UA-24737063-1', 'auto', {'name': 'ga_vimeo_tracker'});  // New tracker.
// 		ga('ga_vimeo_tracker.send','event','ga_vimeo',path,galabel);
// 	});

// // 20180718 スマホでモーダルダイアログ表示をオフ
// 	$('a.sp_disable').click(function(){
// //		var wid = $(window).width();
// 		var wid = window.innerWidth;
// 		if( wid < 767 ){ // ウィンドウ幅が767px未満だったら
// 			var datid = $("a.sp_disable").attr("data-remodal-target");
// 			if(datid){
// 				$("a.sp_disable").attr("href", "javascript:void(0);");
// //				console.log("wid=" + wid +",datid=" + datid);
// 				$("a.sp_disable").attr("datid", datid);
// 				$("a.sp_disable").removeAttr('data-remodal-target');
// 			}
// 		}else{
// 			var datid = $("a.sp_disable").attr("datid");
// 			if(datid){
// 				$("a.sp_disable").attr("href", "");
// //				console.log("wid=" + wid +",datid=" + datid);
// 				$("a.sp_disable").attr("data-remodal-target", datid);
// 				$("a.sp_disable").removeAttr('datid');
// 			}
// 		}
// 	});

// // 20170921 製品・サービス左ナビ、自ページを太字に
// 	if(path.indexOf(PATH_PRODUCT_COMMON) !=-1 ){
// 		var fullurlAry = new Array();
// 		fullurlAry[0] = path + qparam;
// 		if(path.slice(-1) == "/"){
// 			fullurlAry[1] = path + "index.html";
// //			console.log("path + index.html:" + fullurlAry[1]);
// 		}else if(path.slice(-11) == "/index.html"){
// 			fullurlAry[1] = path.replace("/index.html","/");
// //			console.log("/index.html:" + fullurlAry[1]);
// 		}
// 		for(var i = 0;i < fullurlAry.length; i++){
// 			$('#left_navi a[href="' + fullurlAry[i] + '"]').each(function(){
// 				var objLi = $(this).parent();
// //				console.log("[" + i + "]match=" + $(this).attr("href"));
// 				objLi.addClass('current');
// 			});
// 		}
// 	}
// // 20171017 イベント・セミナーで指定日付以降表示されなくなる要素追加
// 	if(path.indexOf(PATH_EVENT) !=-1 ){
// 		var LimitDateAry = "";
// 		$(".limitTag").each(function() {
// 			LimitDateAry = formatLimitDate($(this).attr('data-limit'));
// 			// フォーマットチェックでtrueならば処理
// 			if(LimitDateAry[1]){
// 				// 締切チェック
// 				if(CompareDate(LimitDateAry[0])){
// //					console.log(".limitTag 締切");
// 					$(this).hide();
// 				}else{
// //					console.log(".limitTag 有効");
// 				}
// 			}else{
// 				if(CheckTest()){
// 					alert(".limitTag 型エラー:LimitDateAry[0]=" + LimitDateAry[0]);
// 				}
// 			}
// 		});
// 	}

// });
/* 試験用　CSSにパラメータ付与
$(function() {
	$('link[href$=".css"]').each(function() {
		var href_value= $(this).attr("href") + '?20180626';
		console.log("href_value=" + href_value);
		$(this).attr('href',href_value);
	});
});
*/

// 20171113 モーダルダイアログで動画を表示する処理
// // 20180925 vimeoのレスポンシブ対応に問題があったので処理変更
// $(function(){
// 	$('a.remodal_mv').click(function(){
// 		var mvsrc = $(this).attr('data-mvsrc');
// 		var mvw = $(this).attr('data-width');
// 		var mvh = $(this).attr('data-height');
// 		var wid = window.innerWidth;
// 		var wih = window.innerHeight;
// 		if(isFinite(wid)){
// 			if(wid <= mvw){
// 				mvh = mvh / (Math.floor(mvw/wid)) + 30;
// //				console.log("wid <= mvw mvh=" + mvh);
// 			}
// 		}
// 		if(isFinite(wih)){
// 			if(wih <= mvh){
// 				mvh = wih * 0.8;
// //				console.log("wih <= mvh mvh=" + mvh);
// 			}
// 		}
// 		if (mvsrc.indexOf("vimeo.com") != -1) {
// //			console.log("vimeo");
// 			var paragraph = $('<iframe src="' + mvsrc + '" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" class="remodal_mv" style=""></iframe>');
// 		}else if (mvsrc.indexOf("youtube.com") != -1) {
// //			console.log("youtube");
// //			var paragraph = $('<iframe src="' + mvsrc + '" style="width:' + mvw + ';height:' + mvh + ';" frameborder="0" frameborder="0" allowfullscreen class="remodal_mv"></iframe>');
// 			var paragraph = $('<iframe src="' + mvsrc + '" style="" frameborder="0" frameborder="0" allowfullscreen class="remodal_mv"></iframe>');
// 		}else{
// 			// その他
// 		}
// 		$('.inline_content').css('height',mvh);
// //		$('.inline_content').css('width',mvw);

// 		$('.inline_content').html(paragraph); //書き出し
// 	});
// });

// // 動画再生のremodal画面の表示クローズしたタイミングで、iframeを削除する
// $(document).on('closing', '.remodal', function (e) {
//   $('iframe.remodal_mv').remove();
// //  console.log('Modal is closing');
// });

// 20180424 IR用
$(function(){
	if($('#main_contents2').length){
		// IR資料
		$(".acMenu dt").on("click", function() {
			$(this).toggleClass("active").next().slideToggle();
		});
		// FAQ
		$("#faq-page dt").each(function(i){
			$(this).click(function(){
				$("#faq-page dd").eq(i).slideToggle("fast");
			});
		});
		$("#faq-page dd cite").each(function(i){
			$(this).click(function(){
				$("#faq-page dd").eq(i).slideToggle("fast");
			});
		});
	}
	// 20181002 共通トグルメニューの設定を追加
	$("div.tglMenu div.tgl-title:not(.tgl-embed)").on("click", function() {
		$(this).toggleClass("active").next().slideToggle(300);
	});
});



// // 英語版ページかどうかのチェック
// function checkEnSite(){
// var enUrlAry = new Array();
// enUrlAry[0] = ["/index_en.html"];
// enUrlAry[1] = ["/privacy_en.html"];
// enUrlAry[2] = ["/sitemap_en.html"];
// enUrlAry[3] = ["/sitesearch-result_en.html"];
// enUrlAry[4] = ["/use_en.html"];
// enUrlAry[5] = ["/corp_en/"];
// enUrlAry[6] = ["/ir_en/"];
// enUrlAry[7] = ["/product_en/"];
// enUrlAry[8] = ["/support_en/"];
// //enUrlAry[9] = ["test"];
// var path = window.location.pathname;
// var enFlg = false;

// 	for (var i = 0; i < enUrlAry.length; i++) {
// 		if(path.indexOf(enUrlAry[i]) !=-1 ){
// //			console.log("path=" + path + " , enUrlAry[" + i + "]=" + enUrlAry[i]);
// 			enFlg = true;
// 		}
// 	}
// return enFlg
// }

// // 201805 Cookie同意 英語サイトのみ
// var cookieName = 'cookieAgree';
// var cookieValue = '1';
// //var cookieAgreementStr = '本Webサイトでは、アクセス分析、広告表示など、お客様によりよいサービスをご提供するために一部のサービスにおいて「クッキー（Cookie）」を使用しています。<a href="//www.scsk.jp/use.html" target="_blank">「ご利用条件」</a>をご参照いただき、クッキーを使用することに同意されない場合、無効化（オプトアウト）をお願いいたします。クッキーを無効化せずに本Webサイトの利用を継続することにより、クッキーを使用することにご同意いただいたものとさせていただきます。';
// var cookieAgreementStrEn = 'Certain services on this website use cookies in order to provide better service to visitors (data analysis, advertisements, etc.). The Company asks that visitors to this website read <a href="//www.scsk.jp/use_en.html" target="_blank">[Terms of use]</a> and, should they not agree to the use of cookies, disable cookies in their browser (opt out of their use). If one continues to use this website without disabling cookies, they will be judged as having consented to the use of cookies.';
// var cookieAgreementPre = '<div id="cookieAgreement"><p>';
// var cookieAgreementSuf = '</p><button id="cookieAgreebtn">OK</button></div>';
// $(function(){
// //console.log("---cookieAgreement---");
// var tagStr = cookieAgreementStrEn;
// 	if(checkEnSite()){
// 		if ($.cookie(cookieName) != cookieValue) {
// 			$('#footer').after(cookieAgreementPre + tagStr + cookieAgreementSuf);
// 		}else{
// 			$.cookie(cookieName, cookieValue, {
// 			expires: 365,
// 			path:'/'
// 			});
// 		}
// 		$('#cookieAgreebtn').click(function() {
// 			$('#cookieAgreement').hide();
// 			$.cookie(cookieName, cookieValue, {
// 			expires: 365,
// 			path:'/'
// 			});
// 		});
// 	}
// });
// 20180621 メニューのやつ
/*
$(function() {
  $(".mNav06 .menu__second-level").mouseover(function(){
    $(".mNav06").addClass('on_hover');
    console.log("on");
  }).mouseout(function(){
    console.log("out");
    $(".mNav06").removeClass('on_hover');
  });
});
*/
$(function() {
  $('ul#mNavi2019>li').hover(
    // マウスポインターが画像に乗った時の動作
    function(e) {
	    $(this).addClass('on_hover');
/*	    console.log("on");*/
    },
    // マウスポインターが画像から外れた時の動作
    function(e) {
/*	    console.log("out");*/
	    $(this).removeClass('on_hover');
    }
  );
});


$(function() {
  $('ul#mNavi2019b>li').hover(
    // マウスポインターが画像に乗った時の動作
    function(e) {
	    $(this).addClass('on_hover');
/*	    console.log("on");*/
    },
    // マウスポインターが画像から外れた時の動作
    function(e) {
/*	    console.log("out");*/
	    $(this).removeClass('on_hover');
    }
  );
});




// 20180711 サブナビゲーション
$(function() {
  $('.submenu ul.pagelinks-02-list>li').hover(
    // マウスポインターが画像に乗った時の動作
    function(e) {
	    $(this).addClass('on_hover');
/*	    var litop = $(this).parent().position().top;
	    console.log("litop=" + litop);
	    var navheight = $(this).parent().parent().css('height');
	    console.log("navheight=" + navheight);
	    $('nav.pagelinks-02a ul.pagelinks-02-list>li.menu__mega3:hover div.menu__second-level').css('top',navheight);
*/
/*	    console.log("on");*/
    },
    // マウスポインターが画像から外れた時の動作
    function(e) {
/*	    console.log("out");*/
	    $(this).removeClass('on_hover');
    }
  );
});


/*************************************************************
 * * * * * * * * * * * * * 
 *************************************************************/
$(function() {
// 20180719 サブメニュー制御
	$('#submenuLink').click(function(){
		$('#submenu-f').toggleClass('submenu-f-fadeIn');
//		console.log("#submenuLink click");
	});
/*	$('#submenu-f,#submenu-f a').click(function(){*/
/*	$('#product' + ':not(#submenuLink)').click(function(){*/
	$('#submenu-f, a:not(#submenuLink)').click(function(){
		$('#submenu-f').removeClass('submenu-f-fadeIn');
//		console.log("#submenu-f click");
	});
	
	
	$('.pageTop').hover(
	    // マウスポインターが画像に乗った時の動作
	    function(e) {
		    $(this).addClass('on_hover');
	    },
	    // マウスポインターが画像から外れた時の動作
	    function(e) {
		    $(this).removeClass('on_hover');
	    }
	);
	$('#inquiryLink').hover(
	    // マウスポインターが画像に乗った時の動作
	    function(e) {
		    $(this).addClass('on_hover');
	    },
	    // マウスポインターが画像から外れた時の動作
	    function(e) {
		    $(this).removeClass('on_hover');
	    }
	);
	$('#submenuLink').hover(
	    // マウスポインターが画像に乗った時の動作
	    function(e) {
		    $(this).addClass('on_hover');
	    },
	    // マウスポインターが画像から外れた時の動作
	    function(e) {
		    $(this).removeClass('on_hover');
	    }
	);

});





(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NG5ZJ2');