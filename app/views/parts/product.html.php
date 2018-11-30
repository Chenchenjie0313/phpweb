<section class="contents">
<section  class="bg-gray01">
  <section class="bg-gray01">
    <section class="section" style="padding-bottom:0;">
      <h2 class="h-ttl01">商品・サービス</h2>

      <div class="card-group" style="width:100%">
        <div class="card bg-primary">
          <img alt="車載システム事業への取り組み" src="<?= View::img('car_p_001.jpg'); ?>" />
          <div class="card-body text-center">
            <p class="card-text">インテリアの高級感や快適性を重視される。</p>
          </div>
        </div>
        <div class="card bg-success">
          <img alt="車載システム事業への取り組み" src="<?= View::img('car_m_b_005.jpg'); ?>" />
          <div class="card-body text-center">
            <p class="card-text">人とは違った個性をアピールできる車です。</p>
          </div>
        </div>
        <div class="card bg-primary">
                    <img alt="車載システム事業への取り組み" src="<?= View::img('car_a_001.jpg'); ?>" />
          <div class="card-body text-center">
            <p class="card-text">独特の乗り味が魅力です。</p>
          </div>
        </div>
        <div class="card bg-success">
                    <img alt="車載システム事業への取り組み" src="<?= View::img('car_m_b_004.jpg'); ?>" />
          <div class="card-body text-center">
            <p class="card-text">安全に走れるように設計されている。</p>
          </div>
        </div> 
      </div>
    </section> 
    </section>

  <section class="bg-gray01">
    <section class="section" style="padding-top:10;">
      <div id="product">
        <ul class="slider">
          <li><a href="javascript:void(0)" class="gtm_banner_seihin1"><img src="<?= View::img('car_b_001.jpg'); ?>" alt="" /></a></li>
          <li><a href="javascript:void(0)" class="gtm_banner_seihin1"><img src="<?= View::img('car_b_002.jpg'); ?>" alt="" /></a></li>
          <li><a href="javascript:void(0)" class="gtm_banner_seihin1"><img src="<?= View::img('car_b_003.jpg'); ?>" alt="" /></a></li>
          <li><a href="javascript:void(0)" class="gtm_banner_seihin1"><img src="<?= View::img('car_b_004.jpg'); ?>" alt="" /></a></li>
        </ul>
      </div>
    </section>
  </section>
</section>
<script type="text/javascript">
  $(window).on('load', function(){
    $('#product .slider img').each(function(){
        $(this).css('width', "100%").css('height', 154 + "px");
    });

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