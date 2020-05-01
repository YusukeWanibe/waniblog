  <div id="side" <?php bzb_layout_side(); ?> role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
    <div class="side-inner">
      <div class="side-widget-area">
        
      <?php 
        if( dynamic_sidebar('sidebar') ):
          dynamic_sidebar();
        else:
          $args = array(
            'post_type' => 'post',
            'post_count' => 10
          );
          // クエリ
          $the_query = new WP_Query( $args );
          echo '<div id="recent-posts-3" class="widget_recent_entries side-widget"><div class="side-widget-inner">';
          echo '<h4 class="side-title"><span class="widget-title-inner">最新の投稿</span></h4>';
          echo '<ul>';
          // ループ
          while ( $the_query->have_posts() ) : $the_query->the_post();
          	echo '<li><a href="'.get_post_permalink().'">'.get_the_title().'</a></li>';
          endwhile;
          echo '</ul>';
          echo '</div></div>';
                    
        endif;
        wp_reset_postdata();
      ?>
      </div><!-- //side-widget-area -->
      
    </div>
  </div><!-- /side -->
  