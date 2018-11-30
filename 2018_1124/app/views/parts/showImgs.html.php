<section class="contents">
<section  class="bg-gray01">
  <section class="bg-gray01">
    <section class="section" style="padding-top:10;">
      <div id="product">
        <ul class="slider">
          <li><a href="javascript:void(0)" class="gtm_banner_seihin1"><img src="<?= View::img('a-001.jpg'); ?>" alt="" /></a></li>
          <li><a href="javascript:void(0)" class="gtm_banner_seihin1"><img src="<?= View::img('a-002.jpg'); ?>" alt="" /></a></li>
          <li><a href="javascript:void(0)" class="gtm_banner_seihin1"><img src="<?= View::img('a-003.jpg'); ?>" alt="" /></a></li>
          <li><a href="javascript:void(0)" class="gtm_banner_seihin1"><img src="<?= View::img('a-004.jpg'); ?>" alt="" /></a></li>
        </ul>
      </div>
    </section>
  </section>
</section>
<script type="text/javascript">
  $(document).ready(function(){
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