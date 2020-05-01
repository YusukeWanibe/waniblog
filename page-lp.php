<?php
/*
Template Name: LP
*/
 get_header(); ?>

<div id="content">


<div class="wrap">
  <div id="main" <?php bzb_layout_main(); ?>>
    <div class="main-inner">
    
    <?php
			if ( have_posts() ) :

				while ( have_posts() ) : the_post();

        ?>
        
        
    <article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?>>
      
      <header class="post-header">
        <h1 class="post-title"><?php the_title(); ?></h1>
      </header>
      
      <section class="post-content">
        <?php the_content('続きを読む'); ?>
      </section>

    <?php bzb_get_cta($post->ID); ?>

    </article>
        
        <?php

				endwhile;

			else :
		?>
    
    <p>投稿が見つかりません。</p>
				
    <?php
			endif;
		?>
  
    </div><!-- /main-inner -->
  </div><!-- /main -->
  
  <aside id="side">
    LPサイド
  </aside>

</div><!-- /wrap -->
  
</div><!-- /content -->

<?php get_footer(); ?>


