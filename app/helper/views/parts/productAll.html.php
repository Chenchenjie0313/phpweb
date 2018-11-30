<section class="contents" style="padding-bottom:10px;">
<section  class="bg-gray01">
  <section class="bg-gray01">

    <section class="section" style="padding-top:30px;">
      <h2 class="h-ttl01">商品・サービス</h2>
      <div id="product">
        <ul class="slider">
          <li><a href="javascript:void(0)" class="gtm_banner_seihin1"><img src="<?= View::img('car_b_001.jpg'); ?>" alt="" /></a></li>
          <li><a href="javascript:void(0)" class="gtm_banner_seihin1"><img src="<?= View::img('car_b_002.jpg'); ?>" alt="" /></a></li>
          <li><a href="javascript:void(0)" class="gtm_banner_seihin1"><img src="<?= View::img('car_b_003.jpg'); ?>" alt="" /></a></li>
          <li><a href="javascript:void(0)" class="gtm_banner_seihin1"><img src="<?= View::img('car_b_004.jpg'); ?>" alt="" /></a></li>
        </ul>
      </div>
    </section>

    <section class="section" style="padding-bottom:0px;">

      <div class="card-group" style="width:100%">
        <div class="card">
          <img alt="車載システム事業への取り組み" src="<?= View::img('car_p_001.jpg'); ?>" />
          <div class="card-body text-center">
            <p class="card-text">インテリアの高級感や快適性を重視される。</p>
          </div>
        </div>
        <div class="card">
          <img alt="車載システム事業への取り組み" src="<?= View::img('car_m_b_005.jpg'); ?>" />
          <div class="card-body text-center">
            <p class="card-text">人とは違った個性をアピールできる車です。</p>
          </div>
        </div>
        <div class="card">
                    <img alt="車載システム事業への取り組み" src="<?= View::img('car_a_001.jpg'); ?>" />
          <div class="card-body text-center">
            <p class="card-text">独特の乗り味が魅力です。</p>
          </div>
        </div>
        <div class="card">
                    <img alt="車載システム事業への取り組み" src="<?= View::img('car_m_b_004.jpg'); ?>" />
          <div class="card-body text-center">
            <p class="card-text">安全に走れるように設計されている。</p>
          </div>
        </div> 
      </div>
    </section> 
    </section> 

  <section class="bg-gray01">
    <section class="section" style="padding-bottom:0;">
<ul class="boxLinks heightLineParent"  id="boxList02">
    <li style="margin-bottom:30px;">
      <a href="javascript:void(0)" class="gtm_banner_seihin1">
        <img alt="SVJ／スーパー・ヴェローチェ・イオタ" src="<?= View::img('car_r_001.jpg'); ?>" />
      </a>
    </li>
    <li style="margin-bottom:30px;">
      <a href="javascript:void(0)" class="gtm_banner_seihin1">
        <img alt="SVJ／スーパー・ヴェローチェ・イオタ" src="<?= View::img('car_r_002.jpg'); ?>" />
      </a>
    </li>
    <li style="margin-bottom:30px;">
      <a href="javascript:void(0)" class="gtm_banner_seihin1">
        <img alt="SVJ／スーパー・ヴェローチェ・イオタ" src="<?= View::img('car_r_003.jpg'); ?>" />
      </a>
    </li>
    <li style="margin-bottom:30px;">
      <a href="javascript:void(0)" class="gtm_banner_seihin1">
        <img alt="SVJ／スーパー・ヴェローチェ・イオタ" src="<?= View::img('car_r_004.jpg'); ?>" />
      </a>
    </li>
</ul>
    </section> 

  </section>
</section>
<script type="text/javascript">

  $(window).on('load', function(){

    $('#product .slider img').each(function(){
        $(this).css('width', "100%").css('height', 154 + "px");
    });

    /*
    var changeSameHeight = function($target){
      var maxHeight = 0;
      $target.each(function(){
        var h = $(this).height();
        maxHeight = maxHeight >= h ? maxHeight : h;
      });

      if (maxHeight > 0){
        $target.each(function(){
          $(this).height(maxHeight);
        });
      }

    };

    changeSameHeight($('#boxList01>li'));
    changeSameHeight($('#boxList02>li'));
    changeSameHeight($('#boxList03>li'));*/

    $('#product .slider').bxSlider({
      auto:true,
      controls: false,
      slideWidth: 230,
      minSlides: 2,
      maxSlides: 4,
      moveSlides: 1,
      slideMargin: 20,
      randomStart:true
    });

  });
</script>
</section> 

<style>
.bx-wrapper {
position: relative;
*zoom: 1;
text-align: center;
margin-bottom: 200px;/*ADD 201608*/
background-color: #D0D1D3;
top: 160px;/*ADD 201608*/
}

#product .bx-wrapper{/*ADD 201608*/
margin-bottom: 40px;
top: 0px;
}
.bx-wrapper li:hover{
	opacity: 0.8;
}

.bx-wrapper .bx-pager,
.bx-wrapper .bx-controls-auto {
position: absolute;
width: 100%;
}

.bx-wrapper .bx-loading {
min-height: 50px;
background: url(/public/img/bx_loader.gif) center center no-repeat #fff;
height: 100%;
width: 100%;
position: absolute;
top: 0;
left: 0;
z-index: 2000;
}

.bx-wrapper .bx-controls-direction{
width: 1280px;
position: absolute;
top: 0px;
left: 0px;
right: 0px;
margin-left: auto;
margin-right: auto;
z-index: 100; /*ADD 201608*/
}

.bx-wrapper .bx-pager {
text-align: center;
font-weight: bold;
font-family: Arial;
color: #fff;
padding-top: 20px;
background-color: #f1f1f1;
height: 50px;
}

.bx-wrapper .bx-pager .bx-pager-item,
.bx-wrapper .bx-controls-auto .bx-controls-auto-item {
display: inline-block;
*zoom: 1;
*display: inline;
}

.bx-wrapper .bx-pager.bx-default-pager a {
background-color: #999999;
text-indent: -9999px;
display: block;
width: 10px;
height: 10px;
margin: 0px 5px 0;
outline: 0;
-moz-border-radius: 0px;
-webkit-border-radius: 0px;
border-radius: 0px;
}

.bx-wrapper .bx-pager.bx-default-pager a:hover,
.bx-wrapper .bx-pager.bx-default-pager a.active {
background: #007aff;
}

.bx-wrapper .bx-prev,
.bx-wrapper .bx-next {
background-image: url(/public/img/bx_controls.png);
opacity: 0.8;
}

.bx-wrapper .bx-prev {
left: 10px;
background-position: -0px center;
}

.bx-wrapper .bx-next {
right: 10px;
background-position: -40px center;
}

.bx-wrapper .bx-prev:hover,
.bx-wrapper .bx-next:hover {
opacity: 0.5;
}

.bx-wrapper .bx-controls-direction a {
position: absolute;
top: 0px;
outline: 0;
width: 60px;
height: 450px;
text-indent: -9999px;
z-index: 999;
background-repeat: no-repeat;
}

.bx-wrapper .bx-controls-direction a.disabled {
display: none;
}
#product .bx-wrapper { /* 20151204 */
background-color: transparent;
}
</style>