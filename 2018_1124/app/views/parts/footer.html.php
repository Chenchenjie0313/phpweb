<?php /**{{-- フッダ --}} */ ?>
<div class="pageTop" id="footer_pageTop"><a href="javascript:void(0);"><img src="<?= View::img('pagetop.png'); ?>"/></a></div>
<footer id="footer">
    <p id="copyright">Copyright © 三一 Corporation ALL rights reserved.</p>
</footer>
<script type="text/javascript">
    $("#footer_pageTop.pageTop").on('click', function(){
        $('html,body').velocity("scroll", { offset: "0", mobileHA: false });
    });
    $(function(){
        $("#footer_pageTop.pageTop").hide();
        $('html,body').velocity("scroll", { offset: "0", mobileHA: false });
        $(window).on("scroll", function() {
            var scrollHeight = $(document).height();
            var scrollPosition = $(window).height() + $(window).scrollTop();
            var footHeight = $("#footer").height();

            if ($(window).scrollTop() > 350) { 
                $("#footer_pageTop.pageTop").fadeIn();
            } else {
                $("#footer_pageTop.pageTop").fadeOut();        }
            if ( scrollHeight - scrollPosition  <= footHeight ) {
                $("#footer_pageTop.pageTop a").css({"opacity":"1","position":"absolute","bottom": "-20px"});
            } else {
                $("#footer_pageTop.pageTop a").css({"opacity":"0.8","position":"fixed","bottom": "10px"});
            }
        });
        
    });
</script>
