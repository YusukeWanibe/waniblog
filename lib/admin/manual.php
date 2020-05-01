<?php

class bzb_Admin_start{
  
  protected static $key = 'bzb_option_start';
  
  protected static $theme_options = array();
  
  protected $title = '';
  
  public function __construct(){
    $this->title = '使い方マニュアル';
  }
  
  public function hooks(){
    add_action('admin_init', array( $this, 'mninit'));
    add_action('admin_menu', array( $this, 'add_page'));
  }
  
  public function mninit(){
    register_setting( self::$key, self::$key );
  }
  
  public function add_page(){
    $my = add_menu_page( $this->title, $this->title, 'manage_options', self::$key, array($this, 'admin_page_display'), '' , 0 );
  }
  
  public function admin_head(){
    
  }
  
  
  public function admin_page_display(){
    ?>
    
    <div class="wrap">
      <h2>使い方マニュアル</h2>
      <div class="postbox">
        <h3 class="hndle">はじめに</h3>
        <div class="inside">
<p>Xeoryのダウンロードありがとうございます。このページはXeoryの使い方マニュアルです。ここに書いているとおりに設定して頂ければ全て理想的な設定を行うことができます。<br />
もし、使い方に関してわからないことがあったり、使用中に不具合などがありましたらいつでもお問い合わせください。</p>
<p><a href="https://xeory.jp/contact/" target="_blank">お問い合わせ</a></p>
        </div>
      </div>
      <div class="postbox">
        <h3 class="hndle">使い方マニュアル</h3>
        <div class="inside">
          
          <table class="form-table cmb_metabox">
            <tr>
              <td style="vertical-align: top;">
<h4>STEP.1<br>Xeoryのインストールと設定</h4>
<ul>
        <li><a target="_blank" href="https://xeory.jp/xeory-1st-settings/">Xeoryインストール後の初期設定</a></li>
        <li><a target="_blank" href="https://xeory.jp/xeory-post/">記事の投稿</a></li>
        <li><a target="_blank" href="https://xeory.jp/xeory-cta/">CTAの作成</a></li>
        <li><a target="_blank" href="https://xeory.jp/xeory-fixedpage/">固定ページの使い方</a></li>
        <li><a target="_blank" href="https://xeory.jp/xeory-lp/">ランディングページの作成</a></li>
        <li><a target="_blank" href="https://xeory.jp/category-setting/">カテゴリーの設定</a></li>
        <li><a target="_blank" href="https://xeory.jp/xeory-navigation-menu/">ナビゲーションメニューの設定</a></li>
        <li><a target="_blank" href="https://xeory.jp/xeory-widget/">ウィジェットの設定</a></li>
        <li><a target="_blank" href="https://xeory.jp/page-plugin/">FacebookのPage Pluginの設定</a></li>
        <li><a target="_blank" href="https://xeory.jp/xeory-plugin/">おススメプラグインのインストールと設定</a></li>
          </ul>              </td>
              <td>
                
<h4>STEP.2<br>コンテンツプラン作成</h4>
<ul>

<li><a target="_blank" href="http://bazubu.com/how-search-engine-work-18156.html">検索エンジンの仕組み </a></li>
<li><a target="_blank" href="http://bazubu.com/google-algorithm-18288.html">Googleのアルゴリズムとは </a></li>
<li><a target="_blank" href="http://bazubu.com/contet-seo-18508.html">コンテンツSEOの効果と７つの手順 </a></li>
<li><a target="_blank" href="http://bazubu.com/interpretaiton-of-seo-keyword-18374.html">SEOキーワードと三種類のユーザーニーズ </a></li>
<li><a target="_blank" href="http://bazubu.com/how-to-choose-seo-keywords-18458.html">キーワード選定とコンテンツプランニング </a></li>
</ul>              
<h4>STEP.3<br>コンテンツの作成</h4>
<ul>

<li><a target="_blank" href="http://bazubu.com/what-is-a-content-24305.html">コンテンツとは見た人の生活の質を上げるもの </a></li>

<li><a target="_blank" href="http://bazubu.com/how-to-create-a-good-content-17943.html">SEOコンテンツの作り方 </a></li>

<li><a target="_blank" href="http://bazubu.com/persuasive-2815.html">説得力を上げるための基本文章術 </a></li>

<li><a target="_blank" href="http://bazubu.com/effective-web-writing-for-seo-18035.html">WEBライティングとは </a></li>

<li><a target="_blank" href="http://bazubu.com/wordpress-post-15790.html">集客を最大化するWordPressの投稿方法 </a></li>

</ul>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    
    <?php
  }
  
}


$bzb_Admin_start = new bzb_Admin_start();
$bzb_Admin_start->hooks();



function bzb_get_option_start( $key = '' ){
  return cmb_get_option( bzb_Admin_start::key(), $key );
}