<?php

/* add comment..
* ---------------------------------------- */
add_action ( 'edit_category_form_fields', 'bzb_category_fields');
function bzb_category_fields( $tag ) {
  $t_id = $tag->term_id;
  $cat_meta = get_option( "cat_$t_id");

  $metarobots_array = (isset($cat_meta['bzb_meta_robots'])) ? $cat_meta['bzb_meta_robots'] : "";
  $bzb_category_image = (!isset($cat_meta['bzb_category_image']) || $cat_meta['bzb_category_image'] == '') ? "" :  $cat_meta['bzb_category_image'];
?>
  <tr class="form-field">
    <th><label for="bzb_meta_title">カテゴリーページタイトル</label></th>
    <td><input type="text" name="Cat_meta[bzb_meta_title]" id="bzb_meta_title" size="25" value="<?php if( isset ( $cat_meta['bzb_meta_title']) ) echo esc_html($cat_meta['bzb_meta_title']) ?>" /></td>
  </tr>
  <tr class="form-field">
    <th><label for="bzb_meta_keywords">カテゴリーページ用メタキーワード</label></th>
    <td><input type="text" name="Cat_meta[bzb_meta_keywords]" id="bzb_meta_keywords" size="25" value="<?php if( isset ( $cat_meta['bzb_meta_keywords'] ) ) echo esc_html($cat_meta['bzb_meta_keywords']) ?>" /></td>
  </tr>
  <tr class="form-field">
    <th><label for="bzb_meta_content">カテゴリーイメージ</label></th>
    <td>
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

      <input type="text" id="bzb_category_image" name="Cat_meta[bzb_category_image]" class="regular-text" value="<?php echo esc_url($bzb_category_image);?>" />
      <a class="media-upload" href="JavaScript:void(0);" rel="bzb_category_image">
        <input class="cmb_upload_button button" type="button" value="画像をアップロードする" />
      </a>
      <p class="description">現在のカテゴリーページがSNSでシェアされたときに表示する画像を設定します。実際のカテゴリーページに画像は表示されません。</p>
    </td>
  </tr>
  <tr class="form-field">
    <th><label for="bzb_meta_robots">メタロボット</label></th>
    <td>
      <small>全てのチェックを外すと"index"となります。</small>
      <ul>
        <li>
          <input type="hidden" name="Cat_meta[bzb_meta_robots][0]" value="">
          <input class="cmb_option" type="checkbox" name="Cat_meta[bzb_meta_robots][0]" id="bzb_meta_robots1" value="noindex"  <?php echo ( isset($metarobots_array) && is_array($metarobots_array) && in_array('noindex', $metarobots_array) ) ? 'checked' : '';?> /> <label for="bzb_meta_robots1">noindex</label>
        </li>
        <li>
          <input type="hidden" name="Cat_meta[bzb_meta_robots][1]" value="">
          <input class="cmb_option" type="checkbox" name="Cat_meta[bzb_meta_robots][1]" id="bzb_meta_robots2" value="nofollow" <?php echo ( isset($metarobots_array) && is_array($metarobots_array) && in_array('nofollow', $metarobots_array) ) ? 'checked' : '';?>  /> <label for="bzb_meta_robots2">nofollow</label>
        </li>
      </ul>
    </td>
  </tr>
  <tr class="form-field">
    <th><label for="bzb_meta_content">本文</label></th>
    <td>
      <?php $bzb_meta_content = isset($cat_meta['bzb_meta_content']) ? $cat_meta['bzb_meta_content'] : ''; ?>
      <textarea name="Cat_meta[bzb_meta_content]" id="bzb_eta_content" rows="10"><?php echo stripslashes($bzb_meta_content); ?></textarea>
    </td>
  </tr>

<?php
}


/* add comment..
* ---------------------------------------- */
add_action ( 'edited_term', 'bzb_save_extra_category_fileds');
function bzb_save_extra_category_fileds( $term_id ) {
  if ( isset( $_POST['Cat_meta'] ) ) {
    $t_id = preg_replace('/[\x00-\x1f\x7f]/', '', $term_id);
    $cat_meta = get_option( "cat_" . $t_id);
    $cat_keys = array_keys($_POST['Cat_meta']);

    foreach ($cat_keys as $key){
      if ( isset($_POST['Cat_meta'][$key]) ){
        $cat_meta[$key] = $_POST['Cat_meta'][$key];
      }
    }
    update_option( "cat_" . $t_id, $cat_meta );
  }
}
?>
