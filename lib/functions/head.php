<?php


/* wp_headに表示するMETA/OGP
* ---------------------------------------- */
add_action('wp_head', 'bzb_header_meta', 1);


/* add comment..
* ---------------------------------------- */
function get_bzb_title(){

  global $post;
  $title = '';

  if( ( is_front_page() && is_home() ) || is_home() ){
    $title = get_bloginfo('name');
  }elseif( is_home() ){
    // メインページ
    $title .= '最新記事一覧';
  }elseif( is_search() ){
    // 検索結果ページ
    $title .= '「'.get_search_query().'」の検索結果';
  }elseif( is_404() ){
    // 404ページ
    $title .= 'ページが見つかりませんでした';
  }elseif( is_date() ){
    // 日付別一覧ページ
    if( is_day() ){
      $title .= get_the_time('Y').'年 ';
      $title .= get_the_time('n').'月 ';
      $title .= get_the_time('j').'日';
    }elseif( is_month() ){
      $title .= get_the_time('Y').'年 ';
      $title .= get_the_time('n').'月 ';
    }elseif( is_year() ){
      $title .= get_the_time('Y').'年 ';
    }
    $title .= 'の投稿一覧';
  }elseif( is_post_type_archive() ){
    // カスタムポストアーカイブ
    $title .= post_type_archive_title('', false);
  }elseif( is_category() ){
    // カテゴリーページ
    $t_id = get_category( intval( get_query_var('cat') ) )->term_id;
    $cat_class = get_category($t_id);
    $cat_option = get_option('cat_'.$t_id);
    if( isset($cat_option['bzb_meta_title']) && $cat_option['bzb_meta_title'] !== '' ){
      $title = $cat_option['bzb_meta_title'];
    }else{
      $title = $cat_class->name;
    }
  }elseif( is_tag() ){
    // タグページ
    $title .= single_tag_title('', false);
  }elseif( is_author() ){
    // 著者ページ
    $title .= get_the_author_meta('display_name');
  }else{
    // その他のページ
    $title .= $post->post_title;
  }
  return $title;
}

function bzb_title(){
  echo get_bzb_title();
}


if(!function_exists('bzb_header_meta')){

  function bzb_header_meta(){

    global $post;
    global $term_id;


    $keyword = '';
    $description = '';
    $title = '';
    $type = '';
    $url = '';
    $image = '';


    // カテゴリーディスクリプションのPを削除
    remove_filter('term_description','wpautop');

    // OGP
    // og:title / og:type / og:description
    //
    if( is_front_page() || is_home() ){
      // TOPページ / HOMEページ
      $title = strip_tags(htmlspecialchars_decode(get_bloginfo('title')));
      $type  = 'website';
      $description = get_bloginfo('description');
      $url =  home_url()  .'/';

      $logo_image = get_option('logo_image');
      $def_image = get_option('def_image');
      if( isset($def_image) ){
        $image = $def_image;
      }else{
        $image = $def_image;
      }

      $keyword = get_option('meta_keywords');
    }elseif (is_archive()){
      if( is_category() ){
        // カテゴリーページ
  
        $t_id = get_category( intval( get_query_var('cat') ) )->term_id;
        $cat_class = get_category($t_id);
  
        $cat_option = get_option('cat_'.$t_id);
        if( is_array($cat_option) ){
          $cat_option = array_merge(array(
            'bzb_meta_title' => '',
            'bzb_meta_keywords' => ''),$cat_option);
        }
        if( isset($cat_option['bzb_meta_title']) && $cat_option['bzb_meta_title'] !== '' ){
          $title = $cat_option['bzb_meta_title'];
        }else{
          $title = $cat_class->name;
        }
        $type = 'article';
        $description = esc_attr(category_description()) ;
        $url = get_category_link($t_id);
        if( isset($cat_option['bzb_category_image']) && $cat_option['bzb_category_image'] !== '' )  {
          $image = $cat_option['bzb_category_image'];
        }else{
          $image = get_option('def_image');
        }
        $keyword = $cat_option['bzb_meta_keywords'];
      }elseif( is_date() ){
      // 日付に関連する一覧ページ
       if( is_day() ){
         $title .= get_the_time('Y').'年 ';
         $title .= get_the_time('n').'月 ';
         $title .= get_the_time('j').'日';
         $archive_year  = get_the_time( 'Y' ); 
         $archive_month = get_the_time( 'm' ); 
         $archive_day   = get_the_time( 'd' ); 
         $url = get_day_link( $archive_year, $archive_month, $archive_day );
       }elseif( is_month() ){
         $title .= get_the_time('Y').'年 ';
         $title .= get_the_time('n').'月 ';
         $archive_year  = get_the_time( 'Y' );
         $archive_month = get_the_time( 'm' );
         $url = get_month_link( $archive_year, $archive_month );
       }elseif( is_year() ){
         $title .= get_the_time('Y').'年 ';
         $archive_year  = get_the_time( 'Y' );
         $url = get_year_link( $archive_year );
       }
       $title .= 'の投稿一覧';
      }
    }
  elseif( is_search() ){
      // 検索結果ページ
      $title .= '「'.get_search_query().'」の検索結果';
    }else{
      // その他のページ
      if( isset($post) ){
        $post_meta = get_post_meta($post->ID);
// $content =  html_entity_decode($content,ENT_QUOTES,"UTF-8");
        $title = strip_tags(htmlspecialchars_decode(get_the_title()));
        // ECHO $title;
        $type  = 'article';
        $description = get_post_meta( $post->ID,  'bzb_meta_description', true ) ? get_post_meta( $post->ID,  'bzb_meta_description', true ) : mb_substr(strip_tags($post->post_content), 0, 120);
        $url = get_permalink();
        if( has_post_thumbnail($post->ID) ){
          $pre_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), true);
          if(is_array($pre_image));
          $image =  ( $pre_image[0] );
        }else{
          $image = get_option('def_image');
        }
        $keyword = isset($post_meta['bzb_meta_keywords'][0]) ? $post_meta['bzb_meta_keywords'][0] : '';
      }
    }

    // META
    $meta = '';
    $meta = '<meta name="keywords" content="'.$keyword.'" />' . "\n";
    $meta .= '<meta name="description" content="'.$description.'" />' . "\n";
    $robots = "";
    $set = '';

    if( is_home() || is_front_page() ) {
      $robots = "index";
    }elseif( is_404() || is_search() ) {
      $robots = 'noindex,nofollow';
    }elseif( is_archive() ) {
      if( is_category() ){
        if( (isset($cat_option['bzb_meta_robots'][0]) && $cat_option['bzb_meta_robots'][0] == 'noindex') && (isset($cat_option['bzb_meta_robots'][1]) && $cat_option['bzb_meta_robots'][1] == 'nofollow' ) ){
          $robots = 'noindex,nofollow';
        }elseif( (isset($cat_option['bzb_meta_robots'][0]) && $cat_option['bzb_meta_robots'][0] == 'noindex') && (isset($cat_option['bzb_meta_robots'][1]) && $cat_option['bzb_meta_robots'][1] == null) ){
          $robots = 'noindex';
        }elseif( (isset($cat_option['bzb_meta_robots'][0]) && $cat_option['bzb_meta_robots'][0] == null) && (isset($cat_option['bzb_meta_robots'][1]) && $cat_option['bzb_meta_robots'][1] == 'nofollow' ) ){
          $robots = 'nofollow';
        }else{
          $robots = 'index';
        }
      } else {
        $robots = "index";
      }
    }else{
      if( isset($post) ){
        $post_meta = get_post_meta($post->ID);
        ( isset($post_meta['bzb_meta_robots']) ) ? $bzb_meta_robots_arr = unserialize($post_meta['bzb_meta_robots'][0]): '';
        if( isset($bzb_meta_robots_arr) && in_array("noindex",$bzb_meta_robots_arr) && in_array("nofollow",$bzb_meta_robots_arr) ){
          $robots = 'noindex,nofollow';
        }elseif( isset($bzb_meta_robots_arr) && in_array("noindex",$bzb_meta_robots_arr) ){
          $robots = 'noindex';
        }elseif( isset($bzb_meta_robots_arr) && in_array("nofollow",$bzb_meta_robots_arr) ){
          $robots = 'nofollow';
        }else{
          $robots = 'index';
        }
      }
    }

    if( get_option('blog_public') ){
      $set = '<meta name="robots" content="'.$robots.'" />' . "\n";
    }

    if( is_paged() ){
      $meta.= '<meta name="robots" content="noindex,nofollow">' . "\n";
    }else{
      $meta.= $set;
    }

    $facebook_user_id =  get_option('facebook_user_id');
    if( $facebook_user_id || $facebook_user_id !== '' ){
      $meta .= '<meta property="fb:admins" content="'.esc_html($facebook_user_id).'" />' . "\n";
    }

    $facebook_app_id =  get_option('facebook_app_id');
    if( $facebook_app_id || $facebook_app_id !== '' ){
      $meta .= '<meta property="fb:app_id" content="'.esc_html($facebook_app_id).'" />' . "\n";
    }

    // OGP

    $meta .= '<meta property="og:title" content="'.esc_html($title).'" />' . "\n";
    $meta .= '<meta property="og:type" content="'.esc_html($type).'" />' . "\n";
    $meta .= '<meta property="og:description" content="'.esc_textarea($description).'" />' . "\n";
    $meta .= '<meta property="og:url" content="'.esc_url($url).'" />' . "\n";
    $meta .= '<meta property="og:image" content="'.esc_url($image).'" />' . "\n";
    $meta .= '<meta property="og:locale" content="ja_JP" />' . "\n";
    $meta .= '<meta property="og:site_name" content="'.esc_html(get_bloginfo('name')).'" />' . "\n";
    $meta .= '<link href="https://plus.google.com/'. esc_html(get_option('google_publisher')) .'" rel="publisher" />' . "\n";

    $twitter_id = get_option("twitter_id");
    if( $twitter_id || $twitter_id ){
      $meta .='<meta content="summary" name="twitter:card" />' . "\n";
      $meta .= '<meta content="' .esc_html($twitter_id) . '" name="twitter:site" />'. "\n\n";
    }

    echo $meta;
  }
}

/* ページ固有のJS（ヘッダー内）
* ---------------------------------------- */
add_action('wp_head', 'bzb_post_javascript4head', 888);

function bzb_post_javascript4head(){
  global $post;

  if( !is_object($post) || !is_single() && !is_page() ) {
        return;
  }

  $bzb_post_asset_js4head = get_post_meta( $post->ID ,'bzb_post_asset_js4head', true);

  if( isset($bzb_post_asset_js4head) && is_array($bzb_post_asset_js4head) ) {
    $reset_js = $bzb_post_asset_js4head;
    $js = reset($reset_js);
  } else {
    $js = $bzb_post_asset_js4head;
  }

  if( $js && $js !=='') {
      echo $js;
  }
}


/* ページ固有のcss
* ---------------------------------------- */
add_action('wp_head', 'bzb_post_style', 888);

function bzb_post_style(){
  global $post;

  if( !is_object($post) || !is_single() && !is_page() ) {
        return;
  }

  if( is_array(get_post_meta( $post->ID ,'bzb_post_asset_css')) ) {
    $reset_css = get_post_meta( $post->ID ,'bzb_post_asset_css');
    $css = reset($reset_css);
  } else {
    $css = get_post_meta( $post->ID ,'bzb_post_asset_css');
  }

  if( $css && $css !=='' ) {
  ?>
    <style type="text/css">
      <?php echo $css; ?>
    </style>
  <?php
  }
}


/* ページ固有のjs
* ---------------------------------------- */
add_action('wp_footer', 'bzb_post_javascript', 999);

function bzb_post_javascript(){
  global $post;

  if( !is_object($post) || !is_single() && !is_page() ) {
        return;
  }

  $bzb_post_asset_js = get_post_meta( $post->ID ,'bzb_post_asset_js', true);

  if( isset($bzb_post_asset_js) && is_array($bzb_post_asset_js) ) {
    $reset_js = $bzb_post_asset_js;
    $js = reset($reset_js);
  } else {
    $js = $bzb_post_asset_js;
  }
  if( $js && $js !=='') {
  ?>
      <?php echo $js; ?>
  <?php
  }
}

/*
Wordpressデフォルトのnext/prev出力動作を停止
----------------------------------------------- */
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');


/*
ページネーション（一覧ページ）と分割ページ（マルチページ）タグを出力
----------------------------------------------- */
add_action('wp_head', 'bzb_rel_next_prev_link_tags');//適切なページのヘッダーにnext/prevを表示

function bzb_rel_next_prev_link_tags(){
  if(is_single() || is_page()) {
    //1ページを複数に分けた分割ページ（マルチページ）でのタグ出力
    global $wp_query;

    $multipage = bzb_check_multi_page();

    if($multipage[0] > 1) {
      $prev = bzb_generate_multipage_url('prev');
      $next = bzb_generate_multipage_url('next');
      if($prev) {
        echo '<link rel="prev" href="'.$prev.'" />'.PHP_EOL;
      }
      if($next) {
        echo '<link rel="next" href="'.$next.'" />'.PHP_EOL;
      }
    }
  } else{
    //トップページやカテゴリページなどのページネーションでのタグ出力
    global $paged;

    if ( get_previous_posts_link() ){
      echo '<link rel="prev" href="'.get_pagenum_link( $paged - 1 ).'" />'.PHP_EOL;
    }
    if ( get_next_posts_link() ){
      echo '<link rel="next" href="'.get_pagenum_link( $paged + 1 ).'" />'.PHP_EOL;
    }
  }
}

//分割ページ（マルチページ）URLの取得
function bzb_generate_multipage_url($rel='prev'){
  global $post;

  $url = '';
  $multipage = bzb_check_multi_page();

  if($multipage[0] > 1) {
    $numpages = $multipage[0];
    $page = $multipage[1] == 0 ? 1 : $multipage[1];
    $i = 'prev' == $rel? $page - 1: $page + 1;

    if($i && $i > 0 && $i <= $numpages) {
      if(1 == $i) {
        $url = get_permalink();
      } else {
        if ('' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending'))) {
          $url = add_query_arg('page', $i, get_permalink());
        } else {
          $url = trailingslashit(get_permalink()).user_trailingslashit($i, 'single_paged');
        }
      }
    }
  }
  return $url;
}

//分割ページ（マルチページ）かチェックする
function bzb_check_multi_page(){
  $num_pages    = substr_count(
      $GLOBALS['post']->post_content,
      '<!--nextpage-->'
  ) + 1;

  $current_page = get_query_var( 'page' );

  return array ( $num_pages, $current_page );
}
