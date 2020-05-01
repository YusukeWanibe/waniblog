<?php get_header(); ?>

<div id="content">

  <div id="main" <?php bzb_layout_main(); ?>>
    <div class="main-inner">
    
    <?php
			if ( have_posts() ) :

				while ( have_posts() ) : the_post();
    ?>

      <section class="post-content">
        <?php if( has_post_thumbnail() ){ ?>
        <div class="lp-thumbnail">
          <?php the_post_thumbnail(); ?>
        </div>
        <?php } ?>
        <?php the_content(); ?>
      </section>

    <?php
				endwhile;

			else :
		?>
    
    <p>投稿が見つかりません。</p>
				
    <?php
			endif;
		?>

      <footer class="post-footer">
        <?php bzb_social_buttons();?>       
      </footer>
      
      
    </div><!-- /main-inner -->
  </div><!-- /main -->
  
  <div id="side" <?php bzb_layout_side_lp(); ?>>
    <div class="lp-side-inner">
    
      <?php $lp = get_post_meta($post->ID); ?>
      <?php
      $frm_action = get_post_meta($post->ID, 'frm', true);
      extract($frm_action);
      if(isset($action) && $action !== ''){
      ?>
      <div class="lp-form">
        <h3><?php echo $title; ?></h3>
        <?php echo $action; ?>
          <dl class="name">
            <dt>お名前</dt>
            <dd><?php echo $name; ?></dd>
          </dl>
          <dl class="mail">
            <dt>メールアドレス</dt>
            <dd><?php echo $email; ?></dd>
          </dl>          
          <?php echo $hidden; ?>
          <p class="submit"><?php echo $submit; ?></p>
        </form>

      </div><!-- /lp-form -->
      <?php } ?>
    </div>
  </div>


</div><!-- /content -->

</div><!-- /lp-wrap -->

<?php wp_footer(); ?>
</body>
</html>


