jQuery(document).ready(function($){

// 通常投稿タイトルエリア
var post_title = '.post-php.post-type-post #titlediv,.post-new-php.post-type-post #titlediv';
var post_wrap  = '.post-php.post-type-post #titlewrap,.post-new-php.post-type-post #titlewrap';
var permalink_wrap  = '.post-php.post-type-post #edit-slug-box,.post-new-php.post-type-post #edit-slug-box';
$(post_title).addClass('postbox');
$(post_title).prepend('<h3 class="hndle">記事タイトル</h3>');
$(post_wrap).before('<p class="inside"><small>記事タイトルを入力して下さい。タイトルには対策したいキーワードを入れましょう。 <a href="https://xeory.jp/xeory-post" target="_blank">Xeoryテーマの投稿方法</a></small></p>');
$(post_wrap).after('<p class="inside"><span class="count_title count_wrap"></span><strong>文字</strong> ※全角32文字以内推奨</p>');
$(permalink_wrap).after('<p class="inside" id="permalink_desc"><small>※記事のパーマリンク（URL）を設定します。分かりやすく簡潔なURLを設定しましょう。</small></p>');
$('.misc-pub-section #timestamp').after(' or 予約投稿');
$('.misc-pub-section p').after('<a href="http://bazubu.com/how-to-set-scheduled-post-23756.html" target="_blank">予約投稿の設定方法</a>');
$('#category-add').after('<a href="http://bazubu.com/how-to-choose-seo-keywords-18458.html" target="_blank">キーワード選定とコンテンツプランニング</a>');


// 固定ページタイトルエリア
var post_title_page = '.post-php.post-type-page #titlediv,.post-new-php.post-type-page #titlediv';
var post_wrap_page  = '.post-php.post-type-page #titlewrap,.post-new-php.post-type-page #titlewrap';
var permalink_wrap_page  = '.post-php.post-type-page #edit-slug-box,.post-new-php.post-type-page #edit-slug-box';
$(post_title_page).addClass('postbox');
$(post_title_page).prepend('<h3 class="hndle">固定ページタイトル</h3>');
$(post_wrap_page).before('<p class="inside"><small>タイトルを入力して下さい。 <a href="https://xeory.jp/xeory-post" target="_blank">Xeoryテーマの投稿方法</a></small></p>');
$(post_wrap_page).after('<p class="inside"><span class="count_title count_wrap"></span><strong>文字</strong> ※全角32文字以内推奨</p>');
$(permalink_wrap_page).after('<p class="inside"><small>※記事のパーマリンク（URL）を設定します。分かりやすく簡潔なURLを設定しましょう。</small></p>');

// LPタイトルエリア
var post_title_lp = '.post-php.post-type-lp #titlediv,.post-new-php.post-type-lp #titlediv';
var post_wrap_lp  = '.post-php.post-type-lp #titlewrap,.post-new-php.post-type-lp #titlewrap';
var permalink_wrap_lp  = '.post-php.post-type-lp #edit-slug-box,.post-new-php.post-type-lp #edit-slug-box';
$(post_title_lp).addClass('postbox');
$(post_title_lp).prepend('<h3 class="hndle">リスト取得ランディングページタイトル（キャッチコピー）</h3>');
$(post_wrap_lp).before('<p class="inside"><small>リスト取得ページのタイトルを入力して下さい。ここに入力した内容がリスト取得ページのキャッチコピーとして表示されます。<br>キャッチコピーの内容によってコンバージョン率は変わります。『<a href="http://bazubu.com/catch7rules-29.html" target="_blank">反応率の高いキャッチコピーの作り方</a>』を参考にしましょう</small></p>');
//$(post_wrap_lp).after('<p class="inside"><span class="count_title count_wrap"></span><strong>文字</strong> ※全角32文字以内推奨</p>');
$(permalink_wrap_lp).after('<p class="inside"><small>※記事のパーマリンク（URL）を設定します。分かりやすく簡潔なURLを設定しましょう。</small></p>');

// CTAタイトルエリア
var post_title_cta = '.post-php.post-type-cta #titlediv,.post-new-php.post-type-cta #titlediv';
var post_wrap_cta  = '.post-php.post-type-cta #titlewrap,.post-new-php.post-type-cta #titlewrap';
var permalink_wrap_cta  = '.post-php.post-type-cta #edit-slug-box,.post-new-php.post-type-cta #edit-slug-box';
$(post_title_cta).addClass('postbox');
$(post_title_cta).prepend('<h3 class="hndle">CTAタイトル（キャッチコピー）</h3>');
$(post_wrap_cta).before('<p class="inside"><small>CTAのタイトルを入力して下さい。ここに入力された内容がCTAのキャッチコピーとして表示されます。<br>キャッチコピーの内容によってコンバージョン率は変わります。『<a href="http://bazubu.com/catch7rules-29.html" target="_blank">反応率の高いキャッチコピーの作り方</a>』を参考にしましょう</small></p>');
//$(permalink_wrap_cta).after('<p class="inside"><span class="count_title count_wrap"></span><strong>文字</strong></p>');
$(permalink_wrap_cta).remove();
//共通部分

$('#title').bind('keydown keyup keypress change',function(){
  var thisValueLength = $(this).val().length;
  $('.count_title').html(thisValueLength);
  // $('#permalink_desc').show('fast');
});



$('#bzb_meta_description').bind('keydown keyup keypress change',function(){
  var initDescriptionLength = $(this).val().length;
  $('.count_description').html(initDescriptionLength);
});


// コンテンツエディタ上の注意書き
var editor_before = '.post-php.post-type-post ,.post-new-php.post-type-post';
$( editor_before ).find("#postdivrich").before('<div id="editor-before" class="postbox"><h3 class="hndle">SEO効果を高める投稿方法</h3><div class="inside"><small>以下に本文を入力していきましょう。ユーザーに大きな価値を与える良質なコンテンツを作りましょう。コンテンツが良質でさえあれば、自然にSEOもソーシャルメディアも攻略することができます。また見出しの使い方や画像のALTタグの設定方法によってSEOの効果は変わってきます。『<a href="http://bazubu.com/contet-seo-18508.html" target="_blank">コンテンツSEOの効果と7つの手順</a>』と『<a href="http://bazubu.com/wordpress-post-15790.html" target="_blank">WordPressの投稿方法</a>』を参考にして下さい。</small></div></div>');
$( editor_before ).find('#postdivrich').after($('#bzb_meta_tags'));
$( editor_before ).find('#postdivrich').after($('#postimagediv'));;

// 固定ページコンテンツエディタ上の注意書き
var editor_before_page = '.post-php.post-type-page ,.post-new-php.post-type-page';
//$( editor_before_page ).find('#postdivrich').before('<div id="editor-before" class="postbox"><h3 class="hndle">SEO効果を高める投稿方法</h3><div class="inside"><small>以下に本文を入力していきましょう。ユーザーに大きな価値を与える良質なコンテンツを作りましょう。コンテンツが良質でさえあれば、自然にSEOもソーシャルメディアも攻略することができます。また見出しの使い方や画像のALTタグの設定方法によってSEOの効果は変わってきます。『<a href="http://bazubu.com/contet-seo-18508.html" target="_blank">コンテンツSEOの効果と7つの手順</a>』と『<a href="http://bazubu.com/wordpress-post-15790.html" target="_blank">WordPressの投稿方法</a>』を参考にして下さい。</small></div></div>');
$( editor_before_page ).find('#postdivrich').after($('#bzb_meta_tags_page'));
$( editor_before_page ).find('#postdivrich').after($('#postimagediv'));

// LPコンテンツエディタ上の注意書き
var editor_before_lp = '.post-php.post-type-lp ,.post-new-php.post-type-lp';
$( editor_before_lp ).find('#postdivrich').before('<div id="editor-before" class="postbox"><h3 class="hndle">コンテンツの作成</h3><div class="inside"><small>以下に本文を入力していきましょう。どのように構成すればいいか悩んでいる場合は、『<a href="https://bazubu.com/landing-page-15223.html" target="_blank">ランディングページで平均4,2%の成約率を出すために行っている27の手順</a>』が参考になります。</small></div></div>');
 //$( editor_before_lp ).find('#postimagediv').find('#set-post-thumbnail').before('<div class="inside"><small>リスト取得ランディングページのメイン画像を設定しましょう。『画像をアップロード』ボタンを押して、画像を選んで下さい。<br>このテンプレートでは、○○○px x ○○○px の画像が最も適しています</small></div>');
$( editor_before_lp ).find('#postdivrich').after($('#postimagediv'));

// CTAコンテンツエディタ上の注意書き
var editor_before_cta = '.post-php.post-type-cta,.post-new-php.post-type-cta';
$( editor_before_cta ).find('#postdivrich').before('<div id="editor-before" class="postbox"><h3 class="hndle">コンテンツの作成</h3><div class="inside"><small>はじめての方は『<a href="https://xeory.jp/xeory-cta/" target="_blank">CTAの設定方法</a>』をご確認ください。コンバージョンを上げるなら『<a href="http://bazubu.com/high-cvr-8930.html" target="_blank">ランディングページを作るために徹底している７つの事</a>』が参考になります。</small></div></div>');
//$( editor_before_cta ).find('#postimagediv').find('#set-post-thumbnail').before('<div class="hndle"><small>CTAのメイン画像を設定しましょう。『画像をアップロード』ボタンを押して、画像を選んで下さい。<br>このテンプレートでは、○○○px x ○○○px の画像が最も適しています</small></div>');
$( editor_before_cta ).find('#postdivrich').after($('#postimagediv'));


//要素並べ替え




// レイアウト設定
$('.cmb_id_bzb_post_layout li').each(function(i){
  $(this).attr('id','layout-' + (i+1));
});
var radio = $('.cmb_id_bzb_post_layout');
$('input', radio).css({'opacity': '0'})
//checkedだったら最初からチェックする
.each(function(){
	if ($(this).attr('checked') == 'checked') {
		$(this).next().addClass('checked');
	}
});
//クリックした要素にクラス割り当てる
$('label', radio).click(function() {
	$(this).parent().parent().each(function() {
		$('label',this).removeClass('checked');
	});
	$(this).addClass('checked');
});

// レイアウト設定 - default
$('.cmb_id_post_layout li').each(function(i){
  $(this).attr('id','layout-' + (i+1));
});
var radio_d = $('.cmb_id_post_layout');
$('input', radio_d).css({'opacity': '0'})
//checkedだったら最初からチェックする
.each(function(){
	if ($(this).attr('checked') == 'checked') {
		$(this).next().addClass('checked');
	}
});
//クリックした要素にクラス割り当てる
$('label', radio_d).click(function() {
	$(this).parent().parent().each(function() {
		$('label',this).removeClass('checked');
	});
	$(this).addClass('checked');
});



// CTA

if ($("#bzb_cta2:checked").val()) {
  $('.cmb_id_bzb_cta_select').css('display', 'block');
  $('.cmb_id_bzb_cta_org_title').css('display', 'none');
  $('.cmb_id_bzb_cta_org_image').css('display', 'none');
  $('.cmb_id_bzb_cta_org_content').css('display', 'none');
  $('.cmb_id_bzb_cta_org_button_text').css('display', 'none');
  $('.cmb_id_bzb_cta_org_button_url').css('display', 'none');
} else if ($("#bzb_cta3:checked").val()) {
  $('.cmb_id_bzb_cta_select').css('display', 'none');
  // $('.cmb_id_bzb_cta_org_title').css('display', 'block');
  // $('.cmb_id_bzb_cta_org_image').css('display', 'block');
  // $('.cmb_id_bzb_cta_org_content').css('display', 'block');
  // $('.cmb_id_bzb_cta_org_button_text').css('display', 'block');
  // $('.cmb_id_bzb_cta_org_button_url').css('display', 'block');
} else {
  $('.cmb_id_bzb_cta_select').css('display', 'none');
  $('.cmb_id_bzb_cta_org_title').css('display', 'none');
  $('.cmb_id_bzb_cta_org_image').css('display', 'none');
  $('.cmb_id_bzb_cta_org_content').css('display', 'none');
  $('.cmb_id_bzb_cta_org_button_text').css('display', 'none');
  $('.cmb_id_bzb_cta_org_button_url').css('display', 'none');
  $('#bzb_cta1').attr('checked', 'cheked');
}

$("#bzb_cta1").click(function(){
  $("[name='bzb_cta']").removeAttr("checked");
  $(".cmb_id_bzb_cta_select").hide("fast");
  $(".cmb_id_bzb_cta_org_title").hide("fast");
  $(".cmb_id_bzb_cta_org_image").hide("fast");
  $(".cmb_id_bzb_cta_org_content").hide("fast");
  $('.cmb_id_bzb_cta_org_button_text').hide("fast");
  $('.cmb_id_bzb_cta_org_button_url').hide("fast");
  $(this).attr("checked", true );
});

$("#bzb_cta2").click(function(){
  $("[name='bzb_cta']").removeAttr("checked");
  $(".cmb_id_bzb_cta_select").show("fast");
  $(".cmb_id_bzb_cta_org_title").hide("fast");
  $(".cmb_id_bzb_cta_org_image").hide("fast");
  $(".cmb_id_bzb_cta_org_content").hide("fast");
  $('.cmb_id_bzb_cta_org_button_text').hide("fast");
  $('.cmb_id_bzb_cta_org_button_url').hide("fast");
  $(this).attr("checked", true );
});

$("#bzb_cta3").click(function(){
  $("[name='bzb_cta']").removeAttr("checked");
  $(".cmb_id_bzb_cta_select").hide("fast");
  $(".cmb_id_bzb_cta_org_title").show("fast");
  $(".cmb_id_bzb_cta_org_image").show("fast");
  $(".cmb_id_bzb_cta_org_content").show("fast");
  $('.cmb_id_bzb_cta_org_button_text').show("fast");
  $('.cmb_id_bzb_cta_org_button_url').show("fast");
  $(this).attr("checked", true );
});

//コンテンツ紹介機能
if ($("#use_contents_intro:checked").val()) {
  $("#contents_intros").show("fast");
}

$("#use_contents_intro").click(function(){
  if ($(this).attr('checked') == 'checked') {
    $("#contents_intros").show("fast");
  }else{
    $("#contents_intros").hide("fast");
  }
});



// チェックリストのカウント

// カテゴリーページのタイトルの変更
var cat_page = $('.taxonomy-category');
$('label[for=name]', cat_page).text('カテゴリー名');
$('label[for=slug]', cat_page).text('パーマリンク');
$('label[for=parent]', cat_page).text('親カテゴリー');
$('label[for=description]', cat_page).text('ディスクリプション');


//表示オプション制御
if($("#post_type").val() == 'page'){

    if($("#page_template").val() == 'default'){
      $("#lp_form-hide").removeAttr("checked");
      $("#lp_form").hide("fast");

      $("#postcustom-hide").removeAttr("checked");
      $("#postcustom").hide("fast");
    }else{
      $("#lp_form-hide").attr("checked");
      $("#lp_form").show("fast");

      $("#meta_metabox-hide").removeAttr("checked");
      $("#meta_metabox").hide("fast");

      $("#cta_metabox-hide").removeAttr("checked");
      $("#cta_metabox").hide("fast");
    }
}else if($("#post_type").val() == 'post'){
      $("#postcustom-hide").removeAttr("checked");
      $("#postcustom").hide("fast");

}else{

}



$("[id=page_template]").change(function(){
  if($("#page_template").val() == 'default'){
    $("#lp_form-hide").removeAttr("checked");
    $("#lp_form").hide("fast");

    $("#meta_metabox-hide").attr("checked");
    $("#meta_metabox").show("fast");

    $("#cta_metabox-hide").attr("checked");
    $("#cta_metabox").show("fast");


  }else{
    $("#lp_form-hide").attr("checked");
    $("#lp_form").show("fast");

    $("#meta_metabox-hide").removeAttr("checked");
    $("#meta_metabox").hide("fast");

    $("#cta_metabox-hide").removeAttr("checked");
    $("#cta_metabox").hide("fast");
  }
});




});