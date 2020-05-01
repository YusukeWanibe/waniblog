<?php

/* add comment..
* ---------------------------------------- */
if( !function_exists('bzb_header_social_buttons') ){
  //ヘッダーにおけるソーシャルボタン
  function bzb_header_social_buttons(){

    $facebook_page_url = esc_url(get_option('facebook_page_url'));
    $twitter_from_db = esc_html(get_option('twitter_id'));
    $googleplus_from_db = esc_html(get_option('google_publisher'));
    $feedly_url = urlencode(get_bloginfo('rss2_url'));

    $bzb_header_social_buttons = '';

    $bzb_header_social_buttons .= '<div id="header-sns" class="sp-hide">';
    $bzb_header_social_buttons .=  '<ul>';
    if( isset($facebook_page_url) && $facebook_page_url !== '' ){
      $bzb_header_social_buttons .= '<li class="facebook_icon"><a href="' . $facebook_page_url . '" target="_blank"><i class="fa fa-facebook-square"></i></li>';
    }
    if( isset($twitter_from_db) && $twitter_from_db !== '' ){
      $bzb_header_social_buttons .= '<li class="twitter_icon"><a target="_blank" href="https://twitter.com/' . $twitter_from_db . '"><i class="fa fa-twitter-square"></i></a></li>';
    }
    if( isset($googleplus_from_db) && $googleplus_from_db !== '' ){
      $bzb_header_social_buttons .= '<li class="google_icon"><a target="_blank" href="https://plus.google.com/' . $googleplus_from_db . '"><i class="fa fa-google-plus-square"></i></li>';
    }
    $bzb_header_social_buttons .= '<li class="feedly_icon"><a target="_blank" href="https://feedly.com/i/subscription/feed/' . $feedly_url . '"><i class="fa fa-rss"></i></a></li>';
    $bzb_header_social_buttons .= '</ul>';
    $bzb_header_social_buttons .= '</div>';

    echo $bzb_header_social_buttons;
  }
}


/* add comment..
* ---------------------------------------- */
if(!function_exists('bzb_social_buttons')){
  //記事上下のソーシャルボタン
  function bzb_social_buttons($type=''){


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
      $line_image = get_template_directory_uri()."/lib/images/line.png";
      $line_box_image = get_template_directory_uri()."/lib/images/line-box.png";

      if( isset($cf['bzb_meta_description']) ){
        $bzb_meta_description = $cf['bzb_meta_description'][0];
      }

      $fb_disp_type = '';
      $twitter_disp_type = '';
      $hatena_disp_type = '';
      $pocket_disp_type = '';

      if( $show_like_button ){
        $fb_disp_type = ($type) ? "box_count" : "button_count";
        $like =<<<EOF
    <li class="bzb-facebook">
      <div class="fb-like"
        data-href="{$page_url}"
        data-layout="{$fb_disp_type}"
        data-action="like"
        data-show-faces="false"></div>
    </li>
EOF;
      }

      if($show_tweet_button){
        $twitter_disp_type = ($type) ? 'data-count="vertical"' : '';
        $tweet=<<<EOF
    <li class="bzb-twitter">
      <a href="https://twitter.com/share" class="twitter-share-button" {$twitter_disp_type} data-url="{$page_url}"  data-text="{$post_title}">Tweet</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.async=true;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </li>
EOF;
      }

      if($show_google_button){
        $g_disp_type = ($type) ? 'data-size="tall"' : '';
        $google=<<<EOF
    <li class="bzb-googleplus">
      <div class="g-plusone" data-href="{$page_url_encode}" {$g_disp_type}></div>
    </li>
EOF;
      }

      if($show_hatena_button){
        $hatena_disp_type = ($type) ? 'vertical-balloon' : 'standard';
        $hatena=<<<EOF
    <li class="bzb-hatena">
      <a href="http://b.hatena.ne.jp/entry/{$page_url_encode}" class="hatena-bookmark-button" data-hatena-bookmark-title="{$post_title}" data-hatena-bookmark-layout="{$hatena_disp_type}" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="//b.hatena.ne.jp/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="//b.hatena.ne.jp/js/bookmark_button.js" charset="utf-8" async="async"></script>
    </li>
EOF;
      }

      if($show_pocket_button){
        $pocket_disp_type = ($type) ? 'vertical' : 'horizontal';
        $pocket=<<<EOF
    <li class="bzb-pocket">
      <a href="https://getpocket.com/save" class="pocket-btn" data-lang="ja" data-save-url="{$page_url_encode}" data-pocket-count="{$pocket_disp_type}" data-pocket-align="left" >Pocket</a><script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
    </li>
EOF;
      }

      if($show_line_button){
        if($type){
        $line=<<<EOF
        <li class="bzb-line"><a href="http://line.me/R/msg/text/?{$post_title}%0D%0A{$page_url_encode}" target="_blank"><img src="{$line_box_image}" width="36" height="60" alt="LINEで送る" /></a></li>
EOF;
        }else{
        $line=<<<EOF
        <li class="bzb-line"><a href="http://line.me/R/msg/text/?{$post_title}%0D%0A{$page_url_encode}" target="_blank"><img src="{$line_image}" width="82" height="20" alt="LINEで送る" /></a></li>
EOF;
        }

      }


      $disp_social_buttons .=<<<eof
  <!-- ソーシャルボタン -->
  <ul class="bzb-sns-btn {$type}">
  {$hatena}{$like}{$tweet}{$google}{$pocket}{$line}
  </ul>
  <!-- /bzb-sns-btns -->
eof;

      if($social_flag == 'none'){

      }else{
        echo $disp_social_buttons;
      }

    }else{//if 

    }//if

  }//function

}//exists