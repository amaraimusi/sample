<?php
class UrlCheck{
	
	/**
	 * 正しい表示形式のURLかチェックします。
	 * 日本語など全角文字が入っているとFalseを返します。%が含まれているのもFalseです。
	 * @param unknown_type $url
	 * @return boolean
	 */
	function check($url){
		if (preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,#]+)$/', $url)) {
		    //echo '正しいURLです。';
		    return true;
		} else {
		    //echo '正しくないURLです。';
		    return false;
		}
	}
}