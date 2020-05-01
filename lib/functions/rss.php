<?php

function choice_rss_feed($query) {

  global $wpdb;

  $sql = "select ID from " . $wpdb->prefix . "posts where post_status = 'publish' AND post_type not in ('attachment','nav_menu_item','revision') and ID not in (select post_id from " . $wpdb->prefix . "postmeta where meta_key = 'bzb_include_rss' and meta_value = 'none');";
  $ids = array();
  $results = $wpdb->get_results($sql);
// echo $sql;
  foreach ($results as $value) {
    array_push($ids,$value->ID);
  }
  if ( !$query->is_admin && $query->is_feed) {
      $query->set('post__in', $ids ); // id of page or post
  }
  return $query;

}
add_filter( 'pre_get_posts', 'choice_rss_feed' );