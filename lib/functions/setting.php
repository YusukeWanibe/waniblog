<?php

/* セッティング & 小物系
   WordPress標準の機能はこちらに記入しています。
* ---------------------------------------- */

/* ナビ
* ---------------------------------------- */
// register_nav_menu('primary_nav', 'プライベートナビ（最上部に表示）');
register_nav_menu('global_nav', 'グローバルナビ（ヘッダー領域下に表示）');
register_nav_menu('footer_nav', 'フッターナビ（フッター領域に表示）');

/* ナビにclassを付ける
* ---------------------------------------- */
add_filter( 'nav_menu_css_class', 'bzb_my_nav_menu_css_class', 10, 2 );
function bzb_my_nav_menu_css_class( $classes, $item ) {
  if ( 'page' == $item->object ) {
    $page = get_page_by_title( $item->title );
    $classes[] = $page->post_name;
  } else if ( 'category' == $item->object ) {
    $cat = get_category( get_cat_ID ( $item->title ) );
    $classes[] = $cat->slug;
  }
  return $classes;
}


/* アイキャッチ
* ---------------------------------------- */
// add_theme_support( 'post-thumbnails', array( 'post', 'page', 'cta', 'lp' ) );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 304, 214 ); // 通常の投稿サムネイル
add_image_size( 'post-thumbnail-2nd', 282, 260 ); // 個別投稿、個別の固定ページでのサムネイル

add_action( 'admin_init', 'bzb_my_admin_init' );
function bzb_my_admin_init() {
  add_filter( 'gettext', 'bzb_my_gettext', 10, 3 );
}

function bzb_my_gettext( $translate_text, $text, $domain ) {
  $translate_text = str_replace( 'アイキャッチ画像を設定', '画像をアップロードする', $translate_text );
  $translate_text = str_replace( 'アイキャッチ画像を削除', 'メイン画像を削除する', $translate_text );
  $translate_text = str_replace( 'アイキャッチ画像', 'メイン画像を設定', $translate_text );
  return $translate_text;
}


/* サイドバー
* ---------------------------------------- */
register_sidebar(array(
  'name'          => 'サイドバー',
  'id'            => 'sidebar',
  'description'   => 'サイドバーに入るウィジェットエリアです。',
  'before_widget' => '<div id="%1$s" class="%2$s side-widget"><div class="side-widget-inner">',
  'after_widget'  => '</div></div>',
  'before_title'  => '<h4 class="side-title"><span class="side-title-inner">',
  'after_title'   => '</span></h4>'
));


//ここから
 register_sidebar(array(
 'name' => '投稿記事下',
 'id' => 'under_post_area',
 'description' => '',
 'before_widget' => '<div>',
 'after_widget' => '</div>',
 'before_title' => '<h3>',
 'after_title' => '</h3>'
 ));


/* more-linkのハッシュ消し
* ---------------------------------------- */
add_filter('the_content_more_link', 'bzb_remove_more_jump_link');
function bzb_remove_more_jump_link($link) {
  $offset = strpos($link, '#more-');
  if ( $offset ) {
    $end = strpos($link, '"',$offset);
  }
  if ( $end ) {
    $link = substr_replace($link, '', $offset, $end-$offset);
  }
  return $link;
}


/* more-linkにnofollow
* ---------------------------------------- */
add_filter('the_content', 'bzb_nofollow_more_link');
function bzb_nofollow_more_link($content) {
	return preg_replace("@class=\"more-link\"@", "class=\"more-link\" rel=\"nofollow\"", $content);
}


/* user_setting
* ---------------------------------------- */
add_filter('user_contactmethods', 'bzb_my_user_meta', 10, 1);
function bzb_my_user_meta($bzb_user_info){
  //項目の削除
  //unset($bzb_user_info['xxx']);

  //項目の追加
  $bzb_user_info['facebook'] = 'facebook';
  $bzb_user_info['googleplus'] = 'google+';

  return $bzb_user_info;
}


/* add comment..
* ---------------------------------------- */
add_action( 'user_edit_form_tag', 'bzb_add_enctype_attr2user_edit_form_tag' );
function bzb_add_enctype_attr2user_edit_form_tag() {
  echo ' enctype="multipart/form-data"';
}


/* オリジナルアバター
* ---------------------------------------- */
add_action( 'show_password_fields', 'bzb_add_original_avatar_form' );
function bzb_add_original_avatar_form( $bool ) {
  global $profileuser;
  if ( preg_match( '/^(profile\.php|user-edit\.php)/', basename( $_SERVER['REQUEST_URI'] ) ) ) {
?>

<script type="text/javascript">

jQuery('document').ready(function(){
  jQuery('.media-upload').each(function(){
    var rel = jQuery(this).attr("rel");

    jQuery(this).click(function(){
      window.send_to_editor = function(html) {
        html = '<a>' + html + '</a>';
        imgurl = jQuery('img', html).attr('src');
        jQuery('#'+rel).val(imgurl);
        tb_remove();
      }
      formfield = jQuery('#'+rel).attr('name');
      tb_show(null, 'media-upload.php?post_id=0&type=image&TB_iframe=true');
      return false;
    });
  });
});
</script>

          <tr>
            <th><label for="original_avatar">オリジナルアバター</label></th>
            <td>
              <input type="text" id="original_avatar" name="original_avatar" class="regular-text" value="<?php echo get_user_meta($profileuser->ID, 'original_avatar', true);?>" />
              <a class="media-upload" href="JavaScript:void(0);" rel="original_avatar">
                <input class="cmb_upload_button button" type="button" value="画像をアップロードする" />
              </a>
            </td>
          </tr>
<?php
  }
  return $bool;
}

add_action( 'profile_update', 'bzb_update_original_avatar', 10, 2 );
function bzb_update_original_avatar( $user_id, $old_user_data ) {
    if ( isset( $_POST['original_avatar'] ) && $old_user_data->original_avatar != $_POST['original_avatar'] ) {
        $original_avatar = sanitize_text_field( $_POST['original_avatar'] );
        $original_avatar = wp_filter_kses( $original_avatar );
        $original_avatar = _wp_specialchars( $original_avatar );
        update_user_meta( $user_id, 'original_avatar', $original_avatar );
    }
}


/* add comment..
* ---------------------------------------- */
add_action('wp_dashboard_setup', 'bzb_my_custom_dashboard_widgets');

function bzb_my_custom_dashboard_widgets() {
  global $wp_meta_boxes;
  wp_add_dashboard_widget('custom_help_widget', 'Xeoryからのお知らせ', 'bzb_dashboard_text');
}

function bzb_dashboard_text() {
  echo '<iframe src="https://xeory.jp/if-news/" width="100%" height="300"></iframe><img src="https://xeory.jp/images/xeory.gif" alt="">';
}

if( !function_exists('pagination') ){
  function pagination($pages = '', $range = 4){
    $showitems = ($range * 2)+1;

    global $paged;

    if( empty($paged) ){
      $paged = 1;
    }

    if( $pages == '' ){
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      if(!$pages){
        $pages = 1;
      }
    }

    if(1 != $pages){
      echo "<div class=\"pagination\">";
      if( $paged > 2 && $paged > $range+1 && $showitems < $pages ){
        echo "<a href='".get_pagenum_link(1)."'><i class='fa fa-angle-double-left'></i></a>";
      }
      if( $paged > 1 && $showitems < $pages ){
        echo "<a href='".get_pagenum_link($paged - 1)."'><i class='fa fa-angle-left'></i></a>";
      }
      for ( $i=1; $i <= $pages; $i++ ){
        if ( 1 != $pages && ( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ) ){
          echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">" . $i . "</a>";
        }
      }

      if ( $paged < $pages && $showitems < $pages ){
        echo "<a href=\"".get_pagenum_link($paged + 1)."\"><i class='fa fa-angle-right'></i></a>";
      }
      if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ){
        echo "<a href='".get_pagenum_link($pages)."'><i class='fa fa-angle-double-right'></i></a>";
      }
      echo "</div>\n";
    }
  }
}


/* 検索フォーム
* ---------------------------------------- */
add_filter( 'get_search_form', 'bzb_search_form' );
function bzb_search_form( $form ) {

  $form = '<form role="search" method="get" id="searchform" action="'.home_url( '/' ).'" >
  <div>
  <input type="text" value="' . get_search_query() . '" name="s" id="s" />
  <button type="submit" id="searchsubmit"></button>
  </div>
  </form>';

  return $form;
}


/* メインクエリ
* ---------------------------------------- */
add_action( 'pre_get_posts', 'bzb_customize_main_query' );
if( !function_exists('bzb_customize_main_query') ){
  function bzb_customize_main_query($query) {

    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( $query->is_home() ) {
        $query->set(
           'meta_query',
           array(
             array(  'key'=>'bzb_show_toppage_flag',
                       'compare' => 'NOT EXISTS'
             ),
             array(  'key'=>'bzb_show_toppage_flag',
                       'value'=>'none',
                       'compare'=>'!='
             ),
            'relation'=>'OR'
          )
        );
        $query->set('order','DESC');
    }

   if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
    $query->set( 'post_type', 'post' );
   }
  }
}
