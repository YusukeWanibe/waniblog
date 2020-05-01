<?php

/* likebox
* ---------------------------------------- */
if( !class_exists("MyPagePlugin") ){
  add_action('widgets_init', function(){register_widget('MyPagePlugin' );});
  class MyPagePlugin extends WP_Widget {
    function __construct() {
      parent::__construct(false, $name = 'Page Plugin');
    }

    function widget($args, $instance) {
      extract( $args );
      $facebook_page_url = '';
      $likebox_width = '';
      $likebox_height = '';
      $facebook_app_id = '';
      $show_faces = '';

      $facebook_page_url = get_option('facebook_page_url');
      $likebox_width = isset( $instance['likebox_width'] ) ? $instance['likebox_width']  : 600;
      $likebox_height = isset( $instance['likebox_height'] ) ? $instance['likebox_height']  : 600;

      $show_faces = (isset( $instance['show_faces'] ) && $instance['show_faces'] != '') ? $instance['show_faces']  : "false";
      $small_header = (isset( $instance['small_header'] ) && $instance['small_header'] != '') ? $instance['small_header']  : "false";
      $cover_photo = (isset( $instance['cover_photo'] ) && $instance['cover_photo'] != '') ? $instance['cover_photo']  : "false";
      $page_post = (isset( $instance['page_post'] ) && $instance['page_post'] != '') ? $instance['page_post']  : "false";

      $facebook_app_id = get_option('facebook_app_id');

      $facebook = isset( $instance['facebook'] ) ?apply_filters( 'facebook', $instance['facebook'] ) : "";
      $twitter = isset( $instance['twitter'] ) ? apply_filters( 'twitter', $instance['twitter'] ) : "";
      $googleplus = isset( $instance['googleplus'] ) ? apply_filters( 'googleplus', $instance['googleplus'] ) : "";
      $feedly = isset( $instance['feedly'] ) ? apply_filters( 'feedly', $instance['feedly'] ) : "";
      $n = 0;
      $disp_instance = array($facebook, $twitter, $googleplus, $feedly);
      foreach($disp_instance as $value){
        if($value == '') {continue;}
        $n = $n + 1;
      }//foreach
?>

        <div class="post-share-fb side-widget">

<div class="fb-page" data-href="<?php echo $facebook_page_url;?>" data-width="<?php echo $likebox_width;?>" data-height="<?php echo $likebox_height;?>" data-small-header="<?php echo $small_header;?>" data-adapt-container-width="true" data-hide-cover="<?php echo $cover_photo;?>" data-show-facepile="<?php echo $show_faces;?>" data-show-posts="<?php echo $page_post;?>"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo $facebook_page_url;?>"><a href="<?php echo $facebook_page_url;?>"><?php echo get_option('site_name');?></a></blockquote></div></div>

        </div>
    <?php
    }
    
    function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['likebox_width'] = trim($new_instance['likebox_width']);
      $instance['likebox_height'] = trim($new_instance['likebox_height']);

      $instance['show_faces'] = trim($new_instance['show_faces']);
      $instance['small_header'] = trim($new_instance['small_header']);
      $instance['cover_photo'] = trim($new_instance['cover_photo']);
      $instance['page_post'] = trim($new_instance['page_post']);

      return $instance;
    }

    function form($instance) {

      $likebox_width = ( isset($instance['likebox_width']) && $instance['likebox_width'] !== '' ) ?  esc_attr($instance['likebox_width']) : "250";
      $likebox_height = ( isset($instance['likebox_height']) && $instance['likebox_height'] !== '' ) ?  esc_attr($instance['likebox_height']) : "300";

      $show_faces = ( isset($instance['show_faces']) && $instance['show_faces'] !== '' ) ?  esc_attr($instance['show_faces']) : "false";
      $small_header = ( isset($instance['small_header']) && $instance['small_header'] !== '' ) ?  esc_attr($instance['small_header']) : "false";
      $cover_photo = ( isset($instance['cover_photo']) && $instance['cover_photo'] !== '' ) ?  esc_attr($instance['cover_photo']) : "false";
      $page_post = ( isset($instance['page_post']) && $instance['page_post'] !== '' ) ?  esc_attr($instance['page_post']) : "false";
      ?>
        <p>
           <label for="<?php echo $this->get_field_id('likebox_width'); ?>">
           PAGE PLUGINの幅:
           </label>
          <input class="widefat" id="<?php echo $this->get_field_id('likebox_width'); ?>" name="<?php echo $this->get_field_name('likebox_width'); ?>" type="text" value="<?php echo $likebox_width; ?>" />
        </p>
        <p>
           <label for="<?php echo $this->get_field_id('likebox_height'); ?>">
           PAGE PLUGINの高さ:
           </label>
          <input class="widefat" id="<?php echo $this->get_field_id('likebox_height'); ?>" name="<?php echo $this->get_field_name('likebox_height'); ?>" type="text" value="<?php echo $likebox_height; ?>" />
        </p>
        <p> 
           <label for="<?php echo $this->get_field_id('show_faces'); ?>">
           友人の顔の表示:
           </label>
          <input class="widefat" id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>" type="checkbox" value="true" <?php checked('true', $show_faces);?> />
        </p>
        <p> 
           <label for="<?php echo $this->get_field_id('small_header'); ?>">
           スモールヘッダーを使用:
           </label>
          <input class="widefat" id="<?php echo $this->get_field_id('small_header'); ?>" name="<?php echo $this->get_field_name('small_header'); ?>" type="checkbox" value="true" <?php checked('true', $small_header);?> />
        </p>
        <p> 
           <label for="<?php echo $this->get_field_id('cover_photo'); ?>">
           カバー写真を非表示:
           </label>
          <input class="widefat" id="<?php echo $this->get_field_id('cover_photo'); ?>" name="<?php echo $this->get_field_name('cover_photo'); ?>" type="checkbox" value="true" <?php checked('true', $cover_photo);?> />
        </p>
        <p> 
           <label for="<?php echo $this->get_field_id('page_post'); ?>">
           記事を表示:
           </label>
          <input class="widefat" id="<?php echo $this->get_field_id('page_post'); ?>" name="<?php echo $this->get_field_name('page_post'); ?>" type="checkbox" value="true" <?php checked('true', $page_post);?> />
        </p>


        <?php
    }//form
  }
}
?>