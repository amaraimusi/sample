/**
 * ページ取得。（別ドメインに対応）
 * ☆概要
 * htmlやxmlなどの全テキストをページ情報として取得する。
 * 通常のajaxでは同じドメイン内のページ情報しか取得できないが、このメソッドでは、それが可能。
 * 　ＷＥＢシステムの特性上、いったん取得対象となるＷＥＢページを自サーバーにダウンロードし、
 * ダウンロードしたＷＥＢページからページ情報を取得する。
 * そのため、当処理を行うたびにＷＥＢページのファイルが増えるので注意。
 * get_page.phpと連動している。
 * 
 * ☆注意
 * ＰＨＰサーバー環境が必要
 * ☆履歴
 * 2012/6/12	新規作成
 * */

var ERROR_COMMENT = "ReadingFileErrorOccurred";

/**
 * ページ取得
 * param url ＷＥＢサイトのＵＲＬ（異なるドメインＯＫ）
 * param callBack(data)	コールバック関数。テキスト読み込みが完了したら呼び出される関数。
 * */
function loadAnotherDomain(url,callBack){
  

  $.ajax({
    type: "get",
    data: {
    "url":url
    },
    url: "get_page.php",
    success: callBack});
  
}

