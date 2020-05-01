<?php get_header(); ?>

<div id="content">


  <div class="wrap clearfix">

    <?php bzb_breadcrumb(); ?>

    <div id="main" <?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage">

      <div class="main-inner">

        <article id="post-404" class="cotent-none post" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
          <header class="post-header">
            <h1 class="post-title">あなたがアクセスしようとしたページは削除されたかURLが変更されています。</h1>
          </header>
          <section class="post-content" itemprop="text">
            <?php get_template_part('content', 'none'); ?>
          </section>
        </article>

      </div><!-- /main-inner -->
    </div><!-- /main -->

    <?php get_sidebar(); ?>

  </div><!-- /wrap -->

</div><!-- /content -->

<?php get_footer(); ?>