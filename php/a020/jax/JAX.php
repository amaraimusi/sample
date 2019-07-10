<?php
/**
 *  JAX.php
 *
 *  JSON、Array、XMLを相互に変換する
 *  XMLの属性は"@"、Text Nodeは"#"（※）というKEYの値になる（※オプションあり）
 *  XMLからJSONまたはArrayに変換する場合、root要素名は捨てられる
 *
 *  @version   0.1.1
 *  @see       http://0-oo.net/sbox/php-tool-box/jax
 *  @copyright 2011-2013 dgbadmin@gmail.com
 *  @license   http://0-oo.net/pryn/MIT_license.txt (The MIT license)
 *
 *  See also
 *  @see http://www.php.net/manual/ja/book.simplexml.php
 *  @see http://www.php.net/manual/ja/ref.json.php
 */
class JAX {
	private $_options;
	
	/**
	 *	コンストラクタ
	 *	@param	array	$options	(Optional)
	 */
	public function __construct(array $options = array()) {
		// $opionts['xml_text_#']: XMLのText NodeのKEYを常に"#"にするか
		$this->_options = array_merge(array('xml_text_#' => false), $options);
	}
	/**
	 *	XMLを連想配列にする
	 *	@param	string	$xmlStr
	 *	@param	string	$nameSpace	(Optional) XMLのNameSpace
	 *	@return	array
	 */
	public function xml2array($xmlStr, $nameSpace = '') {
		return $this->_eachXml($this->_str2xml($xmlStr, $nameSpace));
	}
	/**
	 *	XMLをJSONにする
	 *	@param	string	$xmlStr
	 *	@param	string	$nameSpace	(Optional) XMLのNameSpace
	 *	@return	string
	 */
	public function xml2json($xmlStr, $nameSpace = '') {
		return $this->array2json($this->xml2array($xmlStr, $nameSpace));
	}
	/**
	 *	配列（連想配列）をXMLにする
	 *	@param	string	$rootName	root要素名
	 *	@param	array	$arr
	 *	@return	string
	 */
	public function array2xml($rootName, array $arr) {
		return $this->_str2xml($this->_toXmlString($rootName, $arr))->asXML();
	}
	/**
	 *  配列（連想配列）をJSONにする
	 *  @param	array	$arr
	 *  @return	string
	 */
	public function array2json(array $arr) {
		$json = json_encode(
				$arr,
				JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
				);
		
		$this->_validateJson();
		return $json;
	}
	/**
	 *  JSONをXMLにする
	 *	@param	string	$rootName	root要素名
	 *  @param	string	$jsonStr
	 *  @return	string
	 *  @throws	Exception	JSONデコードエラー
	 */
	public function json2xml($rootName, $jsonStr) {
		return $this->array2xml($rootName, $this->json2array($jsonStr));
	}
	/**
	 *  JSONを連想配列にする
	 *  @param	string	$jsonStr
	 *  @return	array
	 *  @throws	Exception	JSONデコードエラー
	 */
	public function json2array($jsonStr) {
		$arr = json_decode($jsonStr, true);
		$this->_validateJson();
		return $arr;
	}
	/**
	 *	文字列からSimpleXMLElementオブジェクトを生成する
	 *	@param	string	$xmlStr
	 *	@param	string	$nameSpace	(Optional) XMLのNameSpace
	 *	@return	SimpleXMLElement
	 */
	private function _str2xml($xmlStr, $nameSpace = '') {
		return new SimpleXMLElement(
				$xmlStr,
				LIBXML_COMPACT | LIBXML_NOERROR,
				false,
				$nameSpace
				);
	}
	/**
	 *	再帰的にXMLを配列にする
	 *	@param	SimpleXMLElement	$xml
	 *	@return	array
	 */
	private function _eachXml(SimpleXMLElement $xml) {
		$arr = array();
		$attrs = (array)$xml->attributes();
		
		if ($attrs) {
			$arr['@'] = $attrs['@attributes'];
		}
		
		if (!$xml->count()) {	// 子要素が無い場合
			$text = (string)$xml;
			
			if ($this->_options['xml_text_#'] || $arr['@']) {
				$arr['#'] = $text;
				return $arr;
			} else {
				return $text;
			}
		}
		
		foreach ($xml->children() as $child) {
			$name = $child->getName();
			$grandchild = $this->_eachXml($child);
			
			if ($arr[$name]) {	// 同名要素が並んでいる場合
				if (is_array($arr[$name]) && $arr[$name][0]) {	// 配列化済みの場合
					$arr[$name][] = $grandchild;
				} else {
					$arr[$name] = array($arr[$name], $grandchild);	// 配列化
				}
			} else {
				$arr[$name] = $grandchild;
			}
		}
		
		return $arr;
	}
	/**
	 *  再帰的に連想配列をXMLにする
	 *  @param	string	$name
	 *  @param	mixed	$data
	 *  @return	string
	 */
	private function _toXmlString($name, $data) {
		$s = '';
		$attr = '';
		
		if (is_array($data)) {
			foreach ($data as $k => $v) {
				if ($k === '@') {
					foreach ($v as $attrName => $attrValue) {
						$attr .= " $attrName=" . '"' . $this->_xmlEscape($attrValue) . '"';
					}
				} else if ($k === '#') {
					$s = $this->_xmlEscape($v);
				} else if (is_numeric($k)) {
					$s .= $this->_toXmlString($name, $v);
				} else {
					$s .= $this->_toXmlString($k, $v);
				}
			}
		} else {
			$s = $this->_xmlEscape($data);
		}
		
		return "<$name$attr>$s</$name>";
	}
	/**
	 *  XMLの文字列エスケープ
	 *  @param	string	$value
	 *  @return	string
	 */
	private function _xmlEscape($value) {
		return htmlSpecialChars($value, ENT_QUOTES, 'UTF-8');
	}
	/**
	 *  JSON変換エラーが発生している場合は例外を投げる
	 *  @throws	Exception
	 */
	private function _validateJson() {
		$error = json_last_error();
		
		if ($error === JSON_ERROR_NONE) {
			return;
		}
		
		$errors = array(
				'JSON_ERROR_DEPTH',
				'JSON_ERROR_STATE_MISMATCH',
				'JSON_ERROR_CTRL_CHAR',
				'JSON_ERROR_SYNTAX',
				'JSON_ERROR_UTF8',
		);
		
		foreach ($errors as $str) {
			if ($error === constant($str)) {
				throw new Exception($str);
			}
		}
		
		throw new Exception("Unknown JSON error ($error)");
	}
}