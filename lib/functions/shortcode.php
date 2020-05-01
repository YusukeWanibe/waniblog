<?php


/* SNSショートコード
* ---------------------------------------- */
add_shortcode('bzb_sns', 'bzb_sc_social_buttons');
function bzb_sc_social_buttons(){

  $disp_social_buttons = '';
  $like = $tweet = $google = $hatena = $pocket = $line = '';
  $show_social_buttons = get_option('show_social_buttons');
  $show_like_button = get_option('show_like_button');
  $show_tweet_button = get_option('show_tweet_button');
  $show_google_button = get_option('show_google_button');
  $show_hatena_button = get_option('show_hatena_button');
  $show_pocket_button = get_option('show_pocket_button');
  $show_line_button = get_option('show_line_button');

  if( !isset($show_social_buttons) || $show_social_buttons !== 'none' ){

    $twitter_id = get_option('twitter_id');
    $page_url = get_permalink();
    $post_title = get_bzb_title();
    $page_url_encode = urlencode($page_url);
    $pid = get_the_ID();
    $social_flag = get_post_meta($pid,'bzb_post_social_buttons',true);
    $line_image = get_stylesheet_directory_uri()."/lib/images/line.png";

    if( isset($cf['bzb_meta_description']) ){
      $bzb_meta_description = $cf['bzb_meta_description'][0];
    }

    if( $show_like_button ){
      $like =<<<EOF
    <li class="bzb-facebook">
      <div class="fb-like"
        data-href="{$page_url}"
        data-layout="button_count"
        data-action="like"
        data-show-faces="false"></div>
    </li>
EOF;
    }

    if($show_tweet_button){
      $tweet=<<<EOF
    <li class="bzb-twitter">
      <a href="https://twitter.com/share" class="twitter-share-button" data-url="{$page_url}"  data-text="{$post_title}">Tweet</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.async=true;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </li>
EOF;
    }

    if($show_google_button){
      $google=<<<EOF
    <li class="bzb-googleplus">
      <div class="g-plusone" data-href="{$page_url_encode}"></div>
    </li>
EOF;
    }

    if($show_hatena_button){
      $hatena=<<<EOF
    <li class="bzb-hatena">
      <a href="http://b.hatena.ne.jp/entry/{$page_url_encode}" class="hatena-bookmark-button" data-hatena-bookmark-title="{$post_title}" data-hatena-bookmark-layout="standard" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="//b.hatena.ne.jp/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a>
      <script type="text/javascript" src="//b.hatena.ne.jp/js/bookmark_button.js" charset="utf-8" async="async"></script>
    </li>
EOF;
    }

    if($show_pocket_button){
      $pocket=<<<EOF
    <li class="bzb-pocket">
      <a href="https://getpocket.com/save" class="pocket-btn" data-lang="ja" data-save-url="{$page_url_encode}" data-pocket-count="horizontal" data-pocket-align="left" >Pocket</a>
      <script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
    </li>
EOF;
    }

    if($show_line_button){
      $line=<<<EOF
      <li class="bzb-line">
        <a href="http://line.me/R/msg/text/?{$post_title}%0D%0A{$page_url_encode}"><img src="{$line_image}" width="82" height="20" alt="LINEで送る" /></a>
      </li>
EOF;
    }


    $disp_social_buttons .=<<<eof
  <!-- ソーシャルボタン -->
  <ul class="bzb-sns-btn">
  {$like}{$tweet}{$google}{$hatena}{$pocket}{$line}
  </ul>
  <!-- /bzb-sns-btns -->
eof;

    return $disp_social_buttons;
  }//if 
}


/* 各種ショートコード
* ---------------------------------------- */
add_shortcode('sitemap', 'bzb_simple_sitemap');
function bzb_simple_sitemap($atts){
  global $wpdb;

  extract(shortcode_atts(
    array(
        'post_type' => 'posts',
        'op' => 0,
      ), $atts
    )
  );
  /* post */
  $custom_post_label = '';
  $echo = '';
  echo '<div id="sitemap">';

  if($post_type == 'custom'){
    $post = get_posts('post_status=publish&post_type=' . $post_type);
    //$custom_post_label = esc_html(get_post_type_object(get_post_type('cta'))->label);  
    foreach ($post as $item){
      //必要ならサムネイルを出すことも可能
      $im = wp_get_attachment_image_src(get_post_thumbnail_id($item->ID),'none',true);
      $date = date('Y.m.d',strtotime(get_post($item->ID)->post_date));
      $update = date('Y.m.d',strtotime(get_post($item->ID)->post_modified));
      $echo .= '<li><a href="'.get_permalink($item->ID).'">'.$item->post_title.'</a></li>' . "\n";
    }
    echo '<ul><li><span class="subheader">' . $custom_post_label .    '投稿一覧</span><ul>';
    echo $echo;
    echo '</ul></li></ul>';
  }elseif( $post_type == 'category' ){
    if( $op == 0 ){
      $args = array(
        'show_option_all'    => NULL,
        'orderby'            => 'name',
        'order'              => 'ASC',
        'show_last_update'   => 0,
        'style'              => 'list',
        'show_count'         => 0,
        'hide_empty'         => 1,
        'use_desc_for_title' => 1,
        'feed'               => NULL,
        'feed_type'          => NULL,
        'feed_image'         => NULL,
        'exclude'            => NULL,
        'exclude_tree'       => NULL,
        'include'            => NULL,
        'hierarchical'       => true,
        'title_li'           => '<span class="subheader">記事カテゴリ</span>',
        'number'             => NULL,
        'echo'               => 1,
        'depth'              => 0,
        'current_category'   => 0,
        'pad_counts'         => 0,
        'taxonomy'           => 'category',
        'walker'             => 'Walker_Category' 
        );
     
      echo '<ul>';
      echo wp_list_categories( $args );
      echo '</ul>';
    }else{
      $post = get_posts('post_status=publish&include='.$op);
      foreach ($post as $item){
        //必要ならサムネイルを出すことも可能
        $echo .= '<li><a href="'.get_permalink($item->ID).'">'.$item->post_title.'</a></li>' . "\n";
      }
      echo '<ul><li><span class="subheader">' . $custom_post_label .    '投稿一覧</span><ul>';
      echo $echo;
      echo '</ul></li></ul>';
    }
  }//if post type
  echo '</div>';
}
