<ul class="bxslider" id="bxslider">
    <li>
      <div id="mainimg" class="mainimg07" style="background-image: url(<?= View::img('tep_001.jpg'); ?>);">
        <a href="javascript:void(0);">
          <img src="<?= View::img('pixel.gif'); ?>" alt="夢ある未来を、共につくる" />
        </a>
        <div class="linkbtn_block">
          <a href="javascript:void(0);" class="linkbtn">
            <span id="linkbtn_link_01">
              <div>夢ある未来を、共につくる</div><!--
              <img src="/public/img/arrow.png" class="arrow" alt="" />-->
            </span>
          </a>
        </div>
      </div>
    </li>
    
    <li>
      <div id="mainimg" class="mainimg05" style="background-image: url(<?= View::img('tmp_002.jpg'); ?>);">
        <a href="javascript:void(0);">
          <img src="<?= View::img('pixel.gif'); ?>" alt="社会とともに、安定的・継続的な成長する" />
        </a>
        <div class="linkbtn_block">
          <a href="/mirai/05_platform/index.html" class="linkbtn">
            <span id="linkbtn_link_02">
              <div>社会とともに、安定的・継続的な成長する</div><!--
              <img src="/public/img/arrow.png" class="arrow" alt="" />-->
            </span>
          </a>
        </div>
      </div>
    </li>
    
    <li>
      <div id="mainimg" class="mainimg06" style="background-image: url(<?= View::img('tmp_003.jpg'); ?>);">
        <a href="javascript:void(0);">
          <img src="<?= View::img('pixel.gif'); ?>" alt="信用を重んじ 確実を旨とする" />
        </a>
        <div class="linkbtn_block">
          <a href="/mirai/05_platform/index.html" class="linkbtn">
            <span id="linkbtn_link_03">
              <div>信用を重んじ 確実を旨とする</div><!--
              <img src="/public/img/arrow.png" class="arrow" alt="" />-->
            </span>
          </a>
        </div>
      </div>
    </li>

</ul>

<style>

#linkbtn_link_01:after {
content: "造る";
white-space: pre;
}
#linkbtn_link_02:after {
content: "成長";
white-space: pre;
}
#linkbtn_link_03:after {
content: "信用";
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