<?php

/* 各種メタボックス保存ルーチン
* ---------------------------------------- */
add_action('save_post', 'bzb_my_box_save');
function bzb_my_box_save($post_id) {
  global $post;
  if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
    return $post_id;
  }

  ( isset($_POST['bzb_meta_keywords']) ) ? update_post_meta($post->ID, 'bzb_meta_keywords', $_POST['bzb_meta_keywords']) : "";
  ( isset($_POST['bzb_meta_description']) ) ? update_post_meta($post->ID, 'bzb_meta_description', str_replace(array("\r\n","\r","\n"), '', $_POST['bzb_meta_description'])) : "";
  ( isset($_POST['bzb_meta_robots']) ) ? update_post_meta($post->ID, 'bzb_meta_robots', $_POST['bzb_meta_robots']) : "";
  ( isset($_POST['bzb_post_layout']) ) ? update_post_meta($post->ID, 'bzb_post_layout', $_POST['bzb_post_layout']) : "";
  ( isset($_POST['bzb_post_asset_js4head']) ) ? update_post_meta($post->ID, 'bzb_post_asset_js4head', $_POST['bzb_post_asset_js4head']) : "";
  ( isset($_POST['bzb_post_asset_css']) ) ? update_post_meta($post->ID, 'bzb_post_asset_css', $_POST['bzb_post_asset_css']) : "";
  ( isset($_POST['bzb_post_asset_js']) ) ? update_post_meta($post->ID, 'bzb_post_asset_js', $_POST['bzb_post_asset_js']) : "";

  ( isset($_POST['bzb_cta']) ) ? update_post_meta($post->ID, 'bzb_cta', $_POST['bzb_cta']) : "";
  ( isset($_POST['bzb_post_front_info']) ) ? update_post_meta($post->ID, 'bzb_post_front_info', $_POST['bzb_post_front_info']) : "";

  ( isset($_POST['bzb_checklists']) ) ? update_post_meta($post->ID, 'bzb_checklists', $_POST['bzb_checklists']) : "";

  ( isset($_POST['frm']) ) ? update_post_meta($post->ID, 'frm', $_POST['frm']) : "";
  ( isset($_POST['bzb_show_toppage_flag']) ) ? update_post_meta($post->ID, 'bzb_show_toppage_flag', $_POST['bzb_show_toppage_flag']) : "";
  ( isset($_POST['bzb_include_rss']) ) ? update_post_meta($post->ID, 'bzb_include_rss', $_POST['bzb_include_rss']) : "";
  ( isset($_POST['bzb_post_social_buttons']) ) ? update_post_meta($post->ID, 'bzb_post_social_buttons', $_POST['bzb_post_social_buttons']) : "";

  ( isset($_POST['bzb_cta_select_button']) ) ? update_post_meta($post->ID, 'bzb_cta_select_button', $_POST['bzb_cta_select_button']) : "";
  ( isset($_POST['bzb_cta_select_button_url']) ) ? update_post_meta($post->ID, 'bzb_cta_select_button_url', $_POST['bzb_cta_select_button_url']) : "";
  ( isset($_POST['bzb_cta_select_button_cvtag']) ) ? update_post_meta($post->ID, 'bzb_cta_select_button_cvtag', $_POST['bzb_cta_select_button_cvtag']) : "";

}


/* add comment..
* ---------------------------------------- */
add_action('add_meta_boxes', 'add_bzb_meta_tags');
function add_bzb_meta_tags() {
  add_meta_box('bzb_meta_tags', 'メタタグを設定', 'bzb_meta_tags', 'post', 'normal', 'high');
}


/* add comment..
* ---------------------------------------- */
function bzb_meta_tags() {
  global $post;

  $metarobots_array = array();
  $metarobots_array = get_post_meta($post->ID, 'bzb_meta_robots', true);
?>
  <p><small>メタタグとはサイトの情報を検索エンジンに正確に提供するために設定する物です。全ての記事で妥協せずに設定するようにしましょう。</small></p>
  <h4>メタディスクリプション</h4>
  <p>
    <small>この記事の要約を書きます。本文を書いた後に入力しても構いません。</small>
  </p>
  <textarea name="bzb_meta_description" id="bzb_meta_description" cols="60" rows="4"><?php echo get_post_meta($post->ID, 'bzb_meta_description', true); ?></textarea><br />
  <span class="count_description"></span>文字 <small>※全角120文字以内推奨</small>
  <h4>メタキーワード</h4>
  <p>
    <small>この記事で対策するキーワードを入力します。1記事1キーワードの推奨します。（もしどうしても複数設定したい場合は小文字のカンマ(,)で区切って下さい）</small>
  </p>
  <input type="text" class="regular-text" name="bzb_meta_keywords" id="bzb_meta_keywords" value="<?php echo get_post_meta($post->ID, 'bzb_meta_keywords', true); ?>" />
  <h4>メタロボット</h4>
  <small>ページのnoindexやnofollowの設定を行います。詳しい使い方や効果は、『<a href="http://bazubu.com/seo101/how-to-use-noindex-tag" target="_blank">noindexの使い方</a>』や『<a href="http://bazubu.com/seo101/how-to-use-nofollow" target="_blank">nofollowの使い方</a>』をご覧下さい。</small>
  <ul>
    <li>
      <input type="hidden" name="bzb_meta_robots[]" value="">
      <label for="bzb_meta_robots1"><input class="cmb_option" type="checkbox" name="bzb_meta_robots[]" id="bzb_meta_robots1" value="noindex"  <?php echo ( is_array($metarobots_array) && in_array('noindex', $metarobots_array) ) ? 'checked' : '';?> /> noindex</label>
    </li>
    <li>
      <input type="hidden" name="bzb_meta_robots[]" value="">
      <label for="bzb_meta_robots2"><input class="cmb_option" type="checkbox" name="bzb_meta_robots[]" id="bzb_meta_robots2" value="nofollow" <?php echo ( is_array($metarobots_array) && in_array('nofollow', $metarobots_array) ) ? 'checked' : '';?>  /> nofollow</label>
    </li>
  </ul>
<?php
}


/* add comment..
* ---------------------------------------- */
add_action('add_meta_boxes', 'add_bzb_meta_tags_page');
function add_bzb_meta_tags_page() {
  add_meta_box('bzb_meta_tags_page', 'メタタグを設定', 'bzb_meta_tags_page', 'page', 'normal', 'high');
}


/* add comment..
* ---------------------------------------- */
function bzb_meta_tags_page() {
  global $post;

  $metarobots_array = array();
  $metarobots_array = get_post_meta($post->ID, 'bzb_meta_robots', true);
?>
  <p><small>メタタグとはサイトの情報を検索エンジンに正確に提供するために設定する物です。</small></p>
  <h4>メタディスクリプション</h4>
  <p>
    <small>この記事の要約を書きます。本文を書いた後に入力しても構いません。</small>
  </p>
  <textarea name="bzb_meta_description" id="bzb_meta_description" cols="60" rows="4"><?php echo get_post_meta($post->ID, 'bzb_meta_description', true); ?></textarea><br />
  <span class="count_description"></span>文字 <small>※全角120文字以内推奨</small>
  <h4>メタキーワード</h4>
  <p>
    <small>この記事で対策するキーワードを入力します。</small>
  </p>
  <input type="text" class="regular-text" name="bzb_meta_keywords" id="bzb_meta_keywords" value="<?php echo get_post_meta($post->ID, 'bzb_meta_keywords', true); ?>" />
  <h4>メタロボット</h4>
  <small>ページのnoindexやnofollowの設定を行います。詳しい使い方や効果は、『<a href="http://bazubu.com/seo101/how-to-use-noindex-tag" target="_blank">noindexの使い方</a>』や『<a href="http://bazubu.com/seo101/how-to-use-nofollow" target="_blank">nofollowの使い方</a>』をご覧下さい。</small>
  <ul>
    <li>
      <input type="hidden" name="bzb_meta_robots[]" value="">
      <label for="bzb_meta_robots1"><input class="cmb_option" type="checkbox" name="bzb_meta_robots[]" id="bzb_meta_robots1" value="noindex"  <?php echo ( is_array($metarobots_array) && in_array('noindex', $metarobots_array) ) ? 'checked' : '';?> /> noindex</label>
    </li>
    <li>
      <input type="hidden" name="bzb_meta_robots[]" value="">
      <label for="bzb_meta_robots2"><input class="cmb_option" type="checkbox" name="bzb_meta_robots[]" id="bzb_meta_robots2" value="nofollow" <?php echo ( is_array($metarobots_array) && in_array('nofollow', $metarobots_array) ) ? 'checked' : '';?>  /> nofollow</label>
    </li>
  </ul>
<?php
}


/* add comment..
* ---------------------------------------- */
add_action('add_meta_boxes', 'add_bzb_post_layout');
function add_bzb_post_layout() {
  add_meta_box('bzb_post_layout', 'レイアウト設定', 'bzb_post_layout', 'post', 'normal', 'low');
  add_meta_box('bzb_post_layout', 'レイアウト設定', 'bzb_post_layout', 'page', 'normal', 'low');
  add_meta_box('bzb_post_layout', 'レイアウト設定', 'bzb_post_layout', 'lp', 'normal', 'low');
}


/* add comment..
* ---------------------------------------- */
function bzb_post_layout() {
  global $post;

  $post_layout = get_post_meta($post->ID, 'bzb_post_layout', true) ? get_post_meta($post->ID, 'bzb_post_layout', true) : "left-content";
?>
<table class="form-table cmb_metabox">
  <tr class="cmb-type-radio_inline cmb_id_bzb_post_layout cmb-inline">
    <td>
     <small>ブログ記事のレイアウトを選択して下さい。</small>
     <ul class="layout-radio">
       <li style="display:inline-block;padding-right:18px;">
         <input type="radio" name="bzb_post_layout" id="bzb_post_layout1" value="left-content" <?php checked ('left-content' , $post_layout);?> />
         <label for="bzb_post_layout1">left-content</label>
       </li>
       <li style="display:inline-block;padding-right:18px;">
         <input type="radio" name="bzb_post_layout" id="bzb_post_layout2" value="right-content" <?php checked ('right-content', $post_layout);?> />
         <label for="bzb_post_layout2">right-content</label>
       </li>
       <li style="display:inline-block;padding-right:18px;">
         <input type="radio" name="bzb_post_layout" id="bzb_post_layout3" value="one-column" <?php checked ('one-column', $post_layout);?> />
         <label for="bzb_post_layout3">one-column</label>
       </li>
     </ul>
    </td>
  </tr>
</table>
<?php
}


/* add comment..
* ---------------------------------------- */
add_action('add_meta_boxes', 'add_bzb_post_asset');
function add_bzb_post_asset() {
  add_meta_box('bzb_post_asset', 'ページ固有のJavascript/CSS', 'bzb_post_asset', 'post', 'normal', 'low');
  add_meta_box('bzb_post_asset', 'ページ固有のJavascript/CSS', 'bzb_post_asset', 'page', 'normal', 'low');
}


/* add comment..
* ---------------------------------------- */
function bzb_post_asset() {
  global $post;

?>
<h4>JavaScript</h4>
<p><small>&lt;/head>タグ直前に書かれます。</small></p>
<pre><textarea name="bzb_post_asset_js4head" id="bzb_post_asset_js4head" cols="100" rows="10" class="cmb_textarea_code"><?php echo get_post_meta($post->ID, 'bzb_post_asset_js4head', true);?></textarea></pre>
<h4>CSS</h4>
<p><small>&lt;/head>タグ直前に書かれます。</small></p>
<pre><textarea name="bzb_post_asset_css" id="bzb_post_asset_css" cols="100" rows="10" class="cmb_textarea_code"><?php echo get_post_meta($post->ID, 'bzb_post_asset_css', true);?></textarea></pre>
<h4>JavaScript</h4>
<p><small>&lt;/body>タグ直前に書かれます。</small></p>
<pre><textarea name="bzb_post_asset_js" id="bzb_post_asset_js" cols="100" rows="10" class="cmb_textarea_code"><?php echo get_post_meta($post->ID, 'bzb_post_asset_js', true);?></textarea></pre>
<?php
}


/* add comment..
* ---------------------------------------- */
add_action('add_meta_boxes', 'bzb_add_mail_form');
function bzb_add_mail_form() {
  add_meta_box('bzb_mail_form', '入力フォームの作成', 'bzb_mail_form', 'lp', 'normal', 'low');
}


/* add comment..
* ---------------------------------------- */
function bzb_mail_form() {
  global $post;

  $action = "";
  $title = "";
  $name = "";
  $email = "";
  $hidden = "";
  $submit = "";

  $frm = get_post_meta($post->ID, 'frm', true);
  if( isset($frm) && $frm !== '' ){
    extract($frm);
  }
?>
<h4>フォームタイトル</h4>
<input type="text" name="frm[title]" id="frm_title" value="<?php echo htmlspecialchars($title, ENT_QUOTES);?>" />
<p><small>メールアドレスなどの入力フォームを作成します。表示したい入力項目を選んで、お使いのメール配信システムのコードを以下の入力欄に入力してください。<br />詳しい使い方は、<a href="https://xeory.jp/xeory-lp" target="_blank">『入力フォームの設定方法』</a>で解説しているので参考にしてください。</small></p>
<p class="lp-example">
  例) フォーム作成サービスを使用する場合の例です。赤字の部分を各入力欄に入れて下さい。<br /><br />
  <span class="text-red">&lt;form method="post" action="*****" target="_blank"></span> …①formタグ<br />
  <span class="text-red">&lt;input type="hidden" name="***" value="*****" /></span> …④hiddenタグ<br />
  <span class="text-red">&lt;input type="hidden" name="***" value="*****" /></span> …④hiddenタグ<br />
  <span class="text-red">&lt;input type="hidden" name="***" value="*****" /></span> …④hiddenタグ<br />
  <br />
  &lt;dl class="pub_form"><br />
  &lt;dt>&lt;font color="red">*&lt;/font>メールアドレス&lt;/dt><br />
  &lt;dd><span class="text-red">&lt;input type="text" name="***" value="" /></span>&lt;/dd> …赤字の部分を③メールアドレス<br />
  &lt;dt>名前&lt;/dt><br />
  &lt;dd><span class="text-red">&lt;input type="text" name="***" value="" /></span>&lt;/dd> …赤字の部分を④お名前<br />
  &lt;/dl><br />
  &lt;hr><br />
  <br />
  &lt;div class="center"><br />
  <span class="text-red">&lt;input type="submit" name="submit" value="　送信　" /></span> …⑤submitタグ<br />
  &lt;/div><br />
  &lt;/form> …こちらは入力しないでください。
</p>


<dl class="lp-form">
  <dt>① formタグ</dt>
    <dd><input type="text" name="frm[action]" id="frm_action" value="<?php echo htmlspecialchars($action, ENT_QUOTES);?>" /></dd>
  <dt>② お名前</dt>
    <dd><input type="text" name="frm[name]" id="frm_name" value="<?php echo htmlspecialchars($name, ENT_QUOTES);?>" /></dd>
  <dt>③ メールアドレス</dt>
    <dd><input type="text" name="frm[email]" id="frm_email" value="<?php echo htmlspecialchars($email, ENT_QUOTES);?>" /></dd>
  <dt>④ hiddenタグ</dt>
    <dd><textarea name="frm[hidden]" id="frm_hidden" cols="60" rows="10" class="cmb_textarea_code"><?php echo $hidden;?></textarea></dd>
  <dt>⑤ submitタグ</dt>
    <dd><input type="text" name="frm[submit]" id="frm_submit" value="<?php echo htmlspecialchars($submit, ENT_QUOTES);?>" /></dd>
</dl>



<?php
}


/* add comment..
* ---------------------------------------- */
add_action('add_meta_boxes', 'add_bzb_cta_button');
function add_bzb_cta_button() {
  add_meta_box('bzb_cta_button', 'CTAで使用するボタンの設定a', 'bzb_cta_button', 'cta', 'normal', 'low');
}


/* add comment..
* ---------------------------------------- */
function bzb_cta_button() {
  global $post;

  $bzb_cta = get_post_meta($post->ID, 'bzb_cta', true);
  $check_cta = "";
  $select_button = "";
  $select_button_url = "";
  $select_button_cvtag = "";

  //print_r($bzb_cta);
  if( is_array($bzb_cta) ){
    extract($bzb_cta);
}
?>
<h4>ボタンに表示されるテキスト</h4>
<input type="text" name="bzb_cta[select_button]" id="bzb_cta_select_button" value="<?php echo esc_html($select_button);?>" />
<h4>ボタンをクリックしたときのリンク先URL</h4>
<input type="text" name="bzb_cta[select_button_url]" id="bzb_cta_select_button_url" value="<?php echo esc_url($select_button_url);?>" />

<?php
}


/* add comment..
* ---------------------------------------- */
add_action('add_meta_boxes', 'add_bzb_cta');
function add_bzb_cta() {
  add_meta_box('ctameta_box', 'CTA設定', 'bzb_post_cta', 'post', 'normal', 'low');
}


/* add comment..
* ---------------------------------------- */
function bzb_post_cta() {
  global $post;
  wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce_cta');
  $saved_bzb_cta = "";
  $saved_bzb_cta = get_post_meta($post->ID, 'bzb_cta', true);
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

<?php
  $bzb_cta = get_post_meta($post->ID, 'bzb_cta', true);
  $check_cta = "";
  $cta_select = "";
  $org_title = "";
  $org_image = "";
  $org_content = "";
  $org_button_text = "";
  $org_button_url = "";

  if( is_array($bzb_cta) ){
    extract($bzb_cta);
  }

?>
<table class="form-table cmb_metabox">
  <tr>
    <td>
      <small>記事直下に表示するCTAを選択して下さい。 <a href="https://xeory.jp/xeory-cta" target="_blank">コンバージョンが取れるCTAの作り方</a></small>
      <ul>
        <li class="cmb_option">
          <input type="radio" name="bzb_cta[check_cta]" id="bzb_cta1" value="none" <?php checked($check_cta, "none");?> />
          <label for="bzb_cta1">表示しない</label>
        </li>
        <li class="cmb_option">
          <input type="radio" name="bzb_cta[check_cta]" id="bzb_cta2" value="custompost" <?php checked($check_cta, "custompost");?> />
          <label for="bzb_cta2">既に作成してあるCTAの中から選ぶ</label>
        </li>
        <li class="cmb_option">
          <input type="radio" name="bzb_cta[check_cta]" id="bzb_cta3" value="pageorg" <?php checked($check_cta, "pageorg");?> />
          <label for="bzb_cta3">このページ独自のCTAを作る</label>
        </li>
      </ul>
      <p class="cmb_metabox_description"></p>
    </td>
  </tr>

  <tr class="cmb-type-cta_select cmb_id_bzb_cta_select">
    <td>
      <h4>既に作成してあるCTAの中から選ぶ</h4>
      <p><small>管理画面メニュー「CTA」で作成した物を下記より選んで下さい。</small></p>
      <?php bzb_cmb_render_cta_select('bzb_cta[cta_select]', $cta_select);?><br /><br />
    </td>
  </tr>

  <tr class="cmb-type-cta_select cmb_id_bzb_cta_org_title">
    <td>
      <h4>ページ独自のCTAタイトル</h4>
      <input type="text" class="regular-text" name="bzb_cta[org_title]" id="bzb_cta_org_title" value="<?php echo esc_html($org_title);?>" />
    </td>
  </tr>

  <tr class="cmb-type-cta_select cmb_id_bzb_cta_org_image">
    <td>
      <h4>画像</h4>
      <input type="text" id="bzb_cta_org_image" name="bzb_cta[org_image]" class="regular-text" value="<?php echo esc_url($org_image);?>" />
      <a class="media-upload" href="JavaScript:void(0);" rel="bzb_cta_org_image">
        <input class="cmb_upload_button button" type="button" value="画像をアップロードする" />
      </a>
    </td>
  </tr>

  <tr class="cmb-type-cta_select cmb_id_bzb_cta_org_content">
    <td>
      <h4>ページ独自のCTAコンテンツ</h4>
      <?php wp_editor( $org_content, 'bzb_cta_org_content', array( 'media_buttons'=>true, 'textarea_name'=>'bzb_cta[org_content]','textarea_rows'=>10,'tiny_mce'=>true, 'tinymce_adv' => array( 'width' => '600')) ); ?>
    </td>
  </tr>

  <tr class="cmb-type-cta_select cmb_id_bzb_cta_org_button_text">
    <td>
      <h4>ボタンに表示されるテキスト</h4>
      <input type="text" class="regular-text" name="bzb_cta[org_button_text]" id="bzb_cta_org_button_text" value="<?php echo esc_html($org_button_text);?>" />
    </td>
  </tr>

  <tr class="cmb-type-cta_select cmb_id_bzb_cta_org_button_url">
    <td>
      <h4>ボタンをクリックしたときのリンク先URL</h4>
      <input type="text" class="regular-text" name="bzb_cta[org_button_url]" id="bzb_cta_org_button_url" value="<?php echo esc_url($org_button_url);?>" />
    </td>
  </tr>

</table>

<?php
}


/* add comment..
* ---------------------------------------- */
add_filter('bzb_cmb_render_cta_select','bzb_cmb_render_cta_select', 10, 2 );
function bzb_cmb_render_cta_select($field, $meta ){

  // クエリ
  $args = array(
    'post_type' => 'cta',
    'showposts' => -1
  );
  $the_query = new WP_Query( $args );
  // ループ
  $cta_loop = '<select name="'.$field.'">';
  foreach($the_query->posts as $cta){
    $selected = selected($cta->ID, $meta, false );
    $cta_loop .= '<option value="'.$cta->ID.'"'.$selected.'>'.esc_html($cta->post_title).'</option>';
  }
  $cta_loop .= '</select>';

  // 投稿データをリセット
  wp_reset_postdata();

  echo $cta_loop;
}


/* ページテンプレート
* ---------------------------------------- */
add_filter( 'cmb_show_on', 'bzb_metabox_show_on_template', 10, 2 );
function bzb_metabox_show_on_template( $display, $meta_box ) {
  if( 'template' !== $meta_box['show_on']['key'] ){
    return $display;
  }

  // Get the current ID
  if( isset( $_GET['post'] ) ){
    $post_id = $_GET['post'];
  }elseif( isset( $_POST['post_ID'] ) ){
    $post_id = $_POST['post_ID'];
  }
  if( !isset( $post_id ) ){
    return false;
  }

  $template_name = get_page_template_slug( $post_id );
  $template_name = substr($template_name, 0, -4);

  // If value isn't an array, turn it into one
  // if template_name is default , get_page_template_slug return null
  $meta_box['show_on']['value'] = !is_array( $meta_box['show_on']['value'] ) ? array( $meta_box['show_on']['value'] ) : $meta_box['show_on']['value'];

  // See if there's a match
  if($template_name == ''){
    return true;
  }else{
    return in_array( $template_name, $meta_box['show_on']['value'] );
  }
}


/* add comment..
* ---------------------------------------- */
add_action('add_meta_boxes', 'add_bzb_checklists');
function add_bzb_checklists() {
  add_meta_box('bzb_checklists', 'SEOチェックポイント', 'bzb_checklists', 'post', 'side', 'low');
}

function bzb_checklists() {
  global $post;
  $checklists = array();
  $checklists = get_post_meta($post->ID, 'bzb_checklists', true);
?>
<input type="hidden" name="bzb_checklists[]" value="">
<table class="form-table cmb_metabox">
  <tr class="cmb-type-multicheck cmb_id_bzb_checklists">
    <label style="display:none;" for="bzb_checklists">チェックリスト</label>
    <td>
      <small>SEO効果を最大化するため、記事更新前に、必要な設定を全てできているかを確認しましょう。</small>
      <ul>
        <li>
          <input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists1" value="check01" <?php echo ( is_array($checklists) && in_array("check01",$checklists) )? "checked='checked'":"";?> />
          <label for="bzb_checklists1">タイトルにキーワードが含まれている</label>
        </li>
        <li>
          <input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists2" value="check02"   <?php echo ( is_array($checklists) && in_array("check02",$checklists) )? "checked='checked'":"";?> />
          <label for="bzb_checklists2">タイトルでベネフィットが伝わっている</label>
        </li>
        <li>
          <input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists3" value="check03"   <?php echo ( is_array($checklists) && in_array("check03",$checklists) )? "checked='checked'":"";?> />
          <label for="bzb_checklists3">タイトルに数字が含まれている</label>
        </li>
        <li>
          <input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists4" value="check04"   <?php echo ( is_array($checklists) && in_array("check04",$checklists) )? "checked='checked'":"";?> />
          <label for="bzb_checklists4">タイトルに簡便性が含まれている</label>
        </li>
        <li>
          <input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists5" value="check05"   <?php echo ( is_array($checklists) && in_array("check05",$checklists) )? "checked='checked'":"";?> />
          <label for="bzb_checklists5">タイトルは32文字以内になっている</label>
        </li>
        <li>
          <input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists6" value="check06"   <?php echo ( is_array($checklists) && in_array("check06",$checklists) )? "checked='checked'":"";?> />
          <label for="bzb_checklists6">メタキーワードを入力している</label>
        </li>
        <li>
          <input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists7" value="check07"   <?php echo ( is_array($checklists) && in_array("check07",$checklists) )? "checked='checked'":"";?> />
          <label for="bzb_checklists7">メタディスクリプションを入力している</label>
        </li>
        <li>
          <input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists8" value="check08"   <?php echo ( is_array($checklists) && in_array("check08",$checklists) )? "checked='checked'":"";?> />
          <label for="bzb_checklists8">本文の見だしタグの順番は適切だ</label>
        </li>
        <li>
          <input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists9" value="check09"   <?php echo ( is_array($checklists) && in_array("check09",$checklists) )? "checked='checked'":"";?> />
          <label for="bzb_checklists9">書き出しで問題提起をしている</label>
        </li>
        <li>
          <input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists10" value="check10"   <?php echo ( is_array($checklists) && in_array("check10",$checklists) )? "checked='checked'":"";?> />
          <label for="bzb_checklists10">書き出しで解決策を提示している</label>
        </li>
        <li>
          <input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists11" value="check11"   <?php echo ( is_array($checklists) && in_array("check11",$checklists) )? "checked='checked'":"";?> />
          <label for="bzb_checklists11">解決策の根拠を提示している</label>
        </li>
     </ul>
     <span class="cmb_metabox_description"></span>
    </td>
  </tr>
</table>

<?php
}


/* add comment..
* ---------------------------------------- */
add_action('add_meta_boxes', 'bzb_add_bzb_show_toppage_flag');
function bzb_add_bzb_show_toppage_flag() {
  add_meta_box('bzb_show_toppage_flag', 'TOPページへの表示', 'bzb_show_toppage_flag', 'post', 'side', 'low');
}

function bzb_show_toppage_flag() {
  global $post;
  $bzb_show_toppage_flag = get_post_meta($post->ID, 'bzb_show_toppage_flag', true);
  $bzb_show_toppage_flag = esc_html($bzb_show_toppage_flag);
?>

<input class="cmb_option" type="hidden" name="bzb_show_toppage_flag" value="" />
<input class="cmb_option" type="checkbox" name="bzb_show_toppage_flag" value="none" <?php checked('none', $bzb_show_toppage_flag);?>/>
チェックを入れた記事はTOPページには表示されなくなります。

<?php
}


/* add comment..
* ---------------------------------------- */
add_action('add_meta_boxes', 'bzb_add_bzb_include_rss');
function bzb_add_bzb_include_rss() {
  add_meta_box('bzb_include_rss', 'RSSへの登録', 'bzb_include_rss', 'post', 'side', 'low');
}

function bzb_include_rss() {
  global $post;
  $bzb_include_rss = get_post_meta($post->ID, 'bzb_include_rss', true);
  $bzb_include_rss = esc_html($bzb_include_rss);
?>
<input class="cmb_option" type="hidden" name="bzb_include_rss" value="" />
<input class="cmb_option" type="checkbox" name="bzb_include_rss" value="none" <?php checked('none', $bzb_include_rss);?>/>
チェックを入れた記事はRSSには含まれなくなります。

<?php
}


/* add comment..
* ---------------------------------------- */
add_action('add_meta_boxes', 'bzb_add_bzb_post_social_buttons');
function bzb_add_bzb_post_social_buttons() {
  add_meta_box('bzb_post_social_buttons', 'ソーシャルボタンの表示', 'bzb_post_social_buttons', 'post', 'side', 'low');
}

function bzb_post_social_buttons() {
  global $post;
  $bzb_post_social_buttons = get_post_meta($post->ID, 'bzb_post_social_buttons', true);
  $bzb_post_social_buttons = esc_html($bzb_post_social_buttons);
?>
<input class="cmb_option" type="hidden" name="bzb_post_social_buttons" value="" />
<input class="cmb_option" type="checkbox" name="bzb_post_social_buttons" value="none" <?php checked('none', $bzb_post_social_buttons);?>/>
チェックを入れた記事にはソーシャルボタンが表示されません。

<?php
}
?>
