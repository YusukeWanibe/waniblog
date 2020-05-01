<?php get_header(); ?>

<div id="content">

  <div class="wrap">

    <?php
    if (!(is_home() || is_front_page())) {
      // パンくず
      bzb_breadcrumb();
    } ?>
    <div id="main" <?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="https://schema.org/Blog">
      <div class="main-inner">


        <?php if (!(is_home() || is_front_page())) { ?>

          <section class="cat-content">
            <header class="cat-header">
              <h1 class="post-title"><?php bzb_title(); ?></h1>
            </header>
          </section>

        <?php } ?>

        <div class="post-loop-wrap">
          <?php
          if (have_posts()) :

            while (have_posts()) : the_post();

          ?>
              <article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="https://schema.org/BlogPosting">

                <header class="post-header">
                  <ul class="post-meta list-inline">
                    <li class="date updated" itemprop="datePublished" datetime="<?php the_time('c'); ?>"><i class="fa fa-clock-o"></i> <?php the_time('Y.m.d'); ?></li>
                  </ul>
                  <h2 class="post-title" itemprop="headline"><a href="<?php the_permalink(); ?>"><?php esc_html(the_title()); ?></a></h2>
                </header>

                <section class="post-content" itemprop="text">

                  <?php if (get_the_post_thumbnail()) { ?>
                    <div class="post-thumbnail">
                      <a href="<?php the_permalink(); ?>" rel="nofollow"><?php the_post_thumbnail(); ?></a>
                    </div>
                  <?php } ?>

                  <?php the_content('続きを読む'); ?>
                </section>

              </article>

            <?php

            endwhile;

          else :
            ?>

            <article id="post-404" class="cotent-none post" itemscope="itemscope" itemtype="https://schema.org/BlogPosting">
              <section class="post-content" itemprop="text">
                <?php echo get_template_part('content', 'none'); ?>
              </section>
            </article>

          <?php
          endif;
          ?>

          <?php if (function_exists("pagination")) {
            pagination($wp_query->max_num_pages);
          } ?>

        </div><!-- /post-loop-wrap -->



      </div><!-- /main-inner -->
    </div><!-- /main -->

    <?php get_sidebar(); ?>

  </div><!-- /wrap -->

</div><!-- /content -->

<?php get_footer(); ?>