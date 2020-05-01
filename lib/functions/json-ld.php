<?php


/* JSON-LD
* ---------------------------------------- */
add_action('wp_head','bzb_json_ld');
function bzb_json_ld (){
  if ( is_page() || is_single() || !is_singular('lp') ) {
    if ( have_posts() ){
      while ( have_posts() ){
        the_post();
        $context = 'http://schema.org';
        $type = 'Article';
        $name = get_the_title();
        $authorType = 'Person';
        $authorName = get_the_author();
        $dataPublished = get_the_date('Y-n-j');
        $image_id = get_post_thumbnail_id();
        $image = wp_get_attachment_image_src($image_id, true);
        $image0 = $image[0];
        // $image = the_post_thumbnail();
        $articleSection = get_the_excerpt();
        $articleBody = get_the_content();
        $url = get_permalink();
        $publisherType = 'Organization';
        $publisherName = get_bloginfo('name');
        $json= "'@context' : '{$context}',
        '@type' : '{$type}',
        'name' : '{$name}',
        'author' : {
          '@type' : '{$authorType}',
          'name' : '{$authorName}'
        },
        'datePublished' : '{$dataPublished}',
        'image' : '{$image0}',
        'articleSection' : '{$articleSection}',
        'articleBody' : '{$articleBody}',
        'url' : '{$url}',
        'publisher' : {
          '@type' : '{$publisherType}',
          'name' : '{$publisherName}'
        }";
        echo '<script type="application/ld+json">{'.$json.'}</script>';
      }
    }
    rewind_posts();
  }
}