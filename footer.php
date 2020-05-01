<footer id="footer">
  <?php if (has_nav_menu('footer_nav')) { ?>
    <div class="footer-01">
      <div class="wrap">
        <?php
        wp_nav_menu(
          array(
            'theme_location'  => 'footer_nav',
            'menu_class'      => '',
            'menu_id'         => 'fnav',
            'container'       => 'nav',
            'items_wrap'      => '<ul id="footer-nav" class="%2$s">%3$s</ul>'
          )
        ); ?>
      </div><!-- /wrap -->
    </div><!-- /footer-01 -->
  <?php } //if footer_nav 
  ?>
  <div class="footer-02">
    <div class="wrap">
      <p class="footer-copy">
        © Copyright <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?>. All rights reserved.
      </p>
    </div><!-- /wrap -->
  </div><!-- /footer-02 -->
  <?php
  // }
  ?>
</footer>
<a href="#" class="pagetop"><span><i class="fa fa-angle-up"></i></span></a>
<?php wp_footer(); ?>
<script>
  (function($) {

    $(function() {
      <?php if (!wp_is_mobile()) { ?>
        $(".sub-menu").css('display', 'none');
        $("#gnav-ul li").hover(function() {
          $(this).children('ul').fadeIn('fast');
        }, function() {
          $(this).children('ul').fadeOut('fast');
        });
      <?php } ?>
      // スマホトグルメニュー
      $('#gnav').removeClass('active');
      $('#header-menu-tog a').click(function() {
        $('#gnav').toggleClass('active');
      });
    });


  })(jQuery);
</script>
</body>

</html>