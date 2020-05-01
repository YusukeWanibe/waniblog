<?php

/* add comment..
* ---------------------------------------- */
add_action( 'after_setup_theme', 'bzb_my_theme_setup' , 12);
function bzb_my_theme_setup(){
    load_theme_textdomain( 'xeory_base', get_stylesheet_directory() . '/lang' );
}


//add_filter( 'admin_post_thumbnail_html', 'bzb_add_featured_image_instruction');
function bzb_add_featured_image_instruction( $content ) {

  switch (esc_html(get_post_type_object(get_post_type())->name)){
    case 'cta' :
      $content .= '<small>CTAのメイン画像を設定しましょう。『画像をアップロード』ボタンを押して、画像を選んで下さい。<br>このテンプレートでは、○○○px x ○○○px の画像が最も適しています</small>';
    break;

    case 'lp' :
      $content .= '<small>LPのメイン画像を設定しましょう。『画像をアップロード』ボタンを押して、画像を選んで下さい。<br>このテンプレートでは、○○○px x ○○○px の画像が最も適しています</small>';
    break;

    default :
      $content .= '<small>メイン画像を設定しましょう。『画像をアップロード』ボタンを押して、画像を選んで下さい。<br>このテンプレートでは、○○○px x ○○○px の画像が最も適しています</small>';
    break;

  }
    return $content;
}
