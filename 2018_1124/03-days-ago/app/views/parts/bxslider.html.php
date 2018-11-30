<ul class="bxslider" id="bxslider">
    <li>
      <div id="mainimg" class="mainimg07" style="background-image: url(<?= View::img('tmp_001.jpg'); ?>);">
        <a href="javascript:void(0);">
          <img src="<?= View::img('pixel.gif'); ?>" alt="夢ある未来を、共につくる" />
        </a>
        <!--
        <div class="linkbtn_block">
          <a href="javascript:void(0);" class="linkbtn">
            <span>
              <div>24時間365日の対応が求められるIT業界。<br />たくさんの課題が・・・</div>
              <img src="/public/img/arrow.png" class="arrow" alt="" />
            </span>
          </a>
        </div>-->
      </div>
    </li>
    
    <li>
      <div id="mainimg" class="mainimg06" style="background-image: url(<?= View::img('tmp_002.jpg'); ?>);">
        <a href="javascript:void(0);">
          <img src="<?= View::img('pixel.gif'); ?>" alt="夢ある未来を、共につくる" />
        </a>
        <!--
        <div class="linkbtn_block">
          <a href="/mirai/05_platform/index.html" class="linkbtn">
            <span>
              <div>夢ある未来を、共につくる</div>
              <img src="/public/img/arrow.png" class="arrow" alt="" />
            </span>
          </a>
        </div>-->
      </div>
    </li>

    <li>
      <div id="mainimg" class="mainimg01" style="background-image: url(<?= View::img('tmp_003.jpg'); ?>);">
        <a href="javascript:void(0);">
          <img src="<?= View::img('pixel.gif'); ?>" alt="夢ある未来を、共につくる" />
        </a>
      </div>
    </li>

  <li>
    <div id="mainimg" class="mainimg01" style="background-image: url(<?= View::img('002.jpg'); ?>);">
      <a href="javascript:void(0);">
          <img src="<?= View::img('pixel.gif'); ?>" alt="夢ある未来を、共につくる" />
      </a>
    </div>
  </li>
</ul>

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