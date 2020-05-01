<?php

/* StyleSheet
* ---------------------------------------- */

if( !is_admin() ){
  add_action('wp_enqueue_scripts', 'bzb_add_style', 9);
  add_action('wp_enqueue_scripts', 'bzb_add_main_style', 10);
  function bzb_register_style(){
    wp_register_style( 'base-css', get_template_directory_uri().'/base.css' );
    wp_register_style( 'main-css', get_theme_file_uri().'/style.css',array('base-css') );
  }
  function bzb_add_style(){
    bzb_register_style();
    wp_enqueue_style('base-css');
  }
  function bzb_add_main_style(){
    wp_enqueue_style('main-css');
  }
}
add_action('wp_enqueue_scripts', 'bzb_add_awesome_style', 9);
function register_awesome_font(){
  wp_register_style( 'font-awesome', get_template_directory_uri() . '/lib/fonts/font-awesome-4.5.0/css/font-awesome.min.css');
}

function bzb_add_awesome_style(){
  register_awesome_font();
  wp_enqueue_style('font-awesome');
}



/* JavaScript
* ---------------------------------------- */

if (!is_admin()) {
  add_action('wp_enqueue_scripts', 'bzb_add_script');
  function bzb_register_script(){
    // トップページへ戻る
    wp_register_script('pagetop', get_template_directory_uri().'/lib/js/jquery.pagetop.js', array('jquery'), false, true );
    wp_register_script('table-scroll', get_template_directory_uri().'/lib/js/jquery.table-scroll.js', array('jquery'), false, true );
  }
  function bzb_add_script() {
    bzb_register_script();
    wp_enqueue_script('pagetop');
    wp_enqueue_script('table-scroll');
  }
}


/* admin
* ---------------------------------------- */
add_action('admin_enqueue_scripts', 'bzb_admin_asset');
function bzb_admin_asset(){

  // CSSファイルを登録
  wp_register_style( 'bzb_admin_css', get_template_directory_uri().'/style_admin.css' );
  // CSSファイルを表示
  wp_enqueue_style( 'bzb_admin_css' );

  // JSファイルを登録
  wp_register_script( 'bzb_admin_js', get_template_directory_uri().'/lib/js/bzb-admin.js', array('jquery') );
  //JSファイルを表示
  wp_enqueue_script('bzb_admin_js');
  wp_enqueue_script('jquery-ui-core');
  wp_enqueue_script('jquery-ui-tabs');
}
