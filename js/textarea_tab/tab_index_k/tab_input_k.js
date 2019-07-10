/**
 * tab_input_k.js
 * 
 * Enter the Tab to the textarea.
 * mit.
 * 
 * @date 2016-4-12
 * @version 0.9
 * @auther kng_uehara
 * 
 * 
 * @param 
 */
function tab_input_k(slt){
	
	var obj = new TabInputK(slt);
	
}

/**
 * テキストエリア・タブ入力クラス
 * @param p_ta_slt テキストエリアのセレクタ
 */
var TabInputK =function(p_ta_slt){
	
	// 出力要素
	this.ta_slt = p_ta_slt;
	
	// 自分自身のインスタンス。  プライベートメソッドやコールバック関数で利用するときに使う。
	var myself=this;
	

	/**
	 * コンストラクタ
	 */
	this.constract=function(){
		
		// フォーカス時のイベント
		 $(this.ta_slt).focus(function(){
			
			// キーダウンイベント
			window.document.onkeydown = function(e){
				
				// Tabキーが押された場合
				if(e.keyCode == 9 && e.shiftKey == false) {   // 9 = Tab
					
					// タブを挿入する
					myself.insertTab(myself.ta_slt);
					e.preventDefault(); // デフォルト動作停止
				}
				
				// Shift + Tabキーが押された場合
				if(e.keyCode == 9 && e.shiftKey == true) {
					
					// タブを除去する（アンシフト）
					myself.unshiftTab(myself.ta_slt);
					e.preventDefault(); // デフォルト動作停止
					
					
				}
				

			}
			
		})

		// フォーカスが外れた時のイベント
		.blur(function(){
			
			// Tabキーの挙動を通常に戻す。
			window.document.onkeydown = function(e){
				return true;
			}
		});
		 
		 
	};
	
	
	
	
	
	/**
	 * タブを挿入する
	 * 
	 * 複数行選択に対するタブ入力も可能
	 * 
	 * @param taSlt テキストエリアのセレクタ
	 */
	this.insertTab = function(taSlt){
		
		var tabStr =  "\t";
		var ta = $(taSlt);
		var sPos = ta[0].selectionStart; // 文字入力最初位置取得
		var ePos = ta[0].selectionEnd; // 文字入力最後位置取得
		
		
		// 選択中の文字列を取得する
		var res = $(this.ta_slt).selection();
		
		// 文字選択されていない場合
		if(res == null || res == ''){

			var line = ta.val(); //文字列を取得
			
			//文字列にタブを挿入し、テキストエリアに再セットする。
			var line2 = line.substr(0,sPos) + tabStr + line.substr(ePos);
			ta.val(line2);
			
			// 文字選択位置を戻す
			var cPos = sPos + tabStr.length;
			ta[0].setSelectionRange(cPos, cPos); 
			
		}
		
		// 文字選択中である場合
		else{

			

			var len_bef = res.length;
			
			// 改行を「改行＋Tab」に置換する。
			res = res.replace(/\r\n|\r|\n/g,'\n\t');
			res = '\t' + res;
			
			var len_aft = res.length;
			
			// 選択範囲を書き換える
			$(this.ta_slt).selection('replace', {text: res});
			
			
			// 文字選択位置を戻す
			var cPos = ePos + len_aft - len_bef;
			ta[0].setSelectionRange(sPos, cPos); 
		}
	};




	/**
	 * タブを除去する（アンシフト）
	 * 
	 * 複数行選択に対するアンシフトも可能
	 * 
	 * @param taSlt テキストエリアのセレクタ
	 */
	this.unshiftTab = function(taSlt){
		var tabStr =  "\t";
		
		// 選択中の文字列を取得する
		var res = $('#ta1').selection();
		
		// 文字選択されていない場合
		if(res == null || res == ''){

			var ta = $(taSlt);
			var sPos = ta[0].selectionStart; // 文字入力最初位置取得
			var ePos = ta[0].selectionEnd; // 文字入力最後位置取得
			
			// 文字列の一番左側を選択中の場合、アンシフトは行わない。
			if (sPos == 0){
				return;
			}

			var line = ta.val(); //文字列を取得
			
			// 選択位置から一つ左側の文字がタブであるか?
			var chkStr = line.substr(sPos-1,1);
			if(chkStr == tabStr){
				// 文字列をアンシフトし、テキストエリアに再セットする
				line =  line.substr(0,sPos-1) + line.substr(ePos);
				ta.val(line);
				
				// 文字選択位置を戻す
				var cPos = sPos - 1;
				ta[0].setSelectionRange(cPos, cPos); 
			}

		}
		
		// 文字選択中である場合
		else{
			
			res = res.replace(/\r\n\t|\r\t|\n\t/g,'\n');
			
			if(res.substr(0,1).match(/\t/)){
				res = res.substr(1,res.length);
			}
			
			// 選択範囲を書き換える
			$('#ta1').selection('replace', {text: res});
			
		}
	};
	
	

	
	
	
	
	
	/*!
	 * jQuery.selection - jQuery Plugin
	 *
	 * Copyright (c) 2010-2014 IWASAKI Koji (@madapaja).
	 * http://blog.madapaja.net/
	 * Under The MIT License
	 *
	 * Permission is hereby granted, free of charge, to any person obtaining
	 * a copy of this software and associated documentation files (the
	 * "Software"), to deal in the Software without restriction, including
	 * without limitation the rights to use, copy, modify, merge, publish,
	 * distribute, sublicense, and/or sell copies of the Software, and to
	 * permit persons to whom the Software is furnished to do so, subject to
	 * the following conditions:
	 *
	 * The above copyright notice and this permission notice shall be
	 * included in all copies or substantial portions of the Software.
	 *
	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
	 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
	 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
	 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
	 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
	 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
	 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	 */
	(function($, win, doc) {
	    /**
	     * get caret status of the selection of the element
	     *
	     * @param   {Element}   element         target DOM element
	     * @return  {Object}    return
	     * @return  {String}    return.text     selected text
	     * @return  {Number}    return.start    start position of the selection
	     * @return  {Number}    return.end      end position of the selection
	     */
	    var _getCaretInfo = function(element){
	        var res = {
	            text: '',
	            start: 0,
	            end: 0
	        };

	        if (!element.value) {
	            /* no value or empty string */
	            return res;
	        }

	        try {
	            if (win.getSelection) {
	                /* except IE */
	                res.start = element.selectionStart;
	                res.end = element.selectionEnd;
	                res.text = element.value.slice(res.start, res.end);
	            } else if (doc.selection) {
	                /* for IE */
	                element.focus();

	                var range = doc.selection.createRange(),
	                    range2 = doc.body.createTextRange();

	                res.text = range.text;

	                try {
	                    range2.moveToElementText(element);
	                    range2.setEndPoint('StartToStart', range);
	                } catch (e) {
	                    range2 = element.createTextRange();
	                    range2.setEndPoint('StartToStart', range);
	                }

	                res.start = element.value.length - range2.text.length;
	                res.end = res.start + range.text.length;
	            }
	        } catch (e) {
	            /* give up */
	        }

	        return res;
	    };

	    /**
	     * caret operation for the element
	     * @type {Object}
	     */
	    var _CaretOperation = {
	        /**
	         * get caret position
	         *
	         * @param   {Element}   element         target element
	         * @return  {Object}    return
	         * @return  {Number}    return.start    start position for the selection
	         * @return  {Number}    return.end      end position for the selection
	         */
	        getPos: function(element) {
	            var tmp = _getCaretInfo(element);
	            return {start: tmp.start, end: tmp.end};
	        },

	        /**
	         * set caret position
	         *
	         * @param   {Element}   element         target element
	         * @param   {Object}    toRange         caret position
	         * @param   {Number}    toRange.start   start position for the selection
	         * @param   {Number}    toRange.end     end position for the selection
	         * @param   {String}    caret           caret mode: any of the following: "keep" | "start" | "end"
	         */
	        setPos: function(element, toRange, caret) {
	            caret = this._caretMode(caret);

	            if (caret === 'start') {
	                toRange.end = toRange.start;
	            } else if (caret === 'end') {
	                toRange.start = toRange.end;
	            }

	            element.focus();
	            try {
	                if (element.createTextRange) {
	                    var range = element.createTextRange();

	                    if (win.navigator.userAgent.toLowerCase().indexOf("msie") >= 0) {
	                        toRange.start = element.value.substr(0, toRange.start).replace(/\r/g, '').length;
	                        toRange.end = element.value.substr(0, toRange.end).replace(/\r/g, '').length;
	                    }

	                    range.collapse(true);
	                    range.moveStart('character', toRange.start);
	                    range.moveEnd('character', toRange.end - toRange.start);

	                    range.select();
	                } else if (element.setSelectionRange) {
	                    element.setSelectionRange(toRange.start, toRange.end);
	                }
	            } catch (e) {
	                /* give up */
	            }
	        },

	        /**
	         * get selected text
	         *
	         * @param   {Element}   element         target element
	         * @return  {String}    return          selected text
	         */
	        getText: function(element) {
	            return _getCaretInfo(element).text;
	        },

	        /**
	         * get caret mode
	         *
	         * @param   {String}    caret           caret mode
	         * @return  {String}    return          any of the following: "keep" | "start" | "end"
	         */
	        _caretMode: function(caret) {
	            caret = caret || "keep";
	            if (caret === false) {
	                caret = 'end';
	            }

	            switch (caret) {
	                case 'keep':
	                case 'start':
	                case 'end':
	                    break;

	                default:
	                    caret = 'keep';
	            }

	            return caret;
	        },

	        /**
	         * replace selected text
	         *
	         * @param   {Element}   element         target element
	         * @param   {String}    text            replacement text
	         * @param   {String}    caret           caret mode: any of the following: "keep" | "start" | "end"
	         */
	        replace: function(element, text, caret) {
	            var tmp = _getCaretInfo(element),
	                orig = element.value,
	                pos = $(element).scrollTop(),
	                range = {start: tmp.start, end: tmp.start + text.length};

	            element.value = orig.substr(0, tmp.start) + text + orig.substr(tmp.end);

	            $(element).scrollTop(pos);
	            this.setPos(element, range, caret);
	        },

	        /**
	         * insert before the selected text
	         *
	         * @param   {Element}   element         target element
	         * @param   {String}    text            insertion text
	         * @param   {String}    caret           caret mode: any of the following: "keep" | "start" | "end"
	         */
	        insertBefore: function(element, text, caret) {
	            var tmp = _getCaretInfo(element),
	                orig = element.value,
	                pos = $(element).scrollTop(),
	                range = {start: tmp.start + text.length, end: tmp.end + text.length};

	            element.value = orig.substr(0, tmp.start) + text + orig.substr(tmp.start);

	            $(element).scrollTop(pos);
	            this.setPos(element, range, caret);
	        },

	        /**
	         * insert after the selected text
	         *
	         * @param   {Element}   element         target element
	         * @param   {String}    text            insertion text
	         * @param   {String}    caret           caret mode: any of the following: "keep" | "start" | "end"
	         */
	        insertAfter: function(element, text, caret) {
	            var tmp = _getCaretInfo(element),
	                orig = element.value,
	                pos = $(element).scrollTop(),
	                range = {start: tmp.start, end: tmp.end};

	            element.value = orig.substr(0, tmp.end) + text + orig.substr(tmp.end);

	            $(element).scrollTop(pos);
	            this.setPos(element, range, caret);
	        }
	    };

	    /* add jQuery.selection */
	    $.extend({
	        /**
	         * get selected text on the window
	         *
	         * @param   {String}    mode            selection mode: any of the following: "text" | "html"
	         * @return  {String}    return
	         */
	        selection: function(mode) {
	            var getText = ((mode || 'text').toLowerCase() === 'text');

	            try {
	                if (win.getSelection) {
	                    if (getText) {
	                        // get text
	                        return win.getSelection().toString();
	                    } else {
	                        // get html
	                        var sel = win.getSelection(), range;

	                        if (sel.getRangeAt) {
	                            range = sel.getRangeAt(0);
	                        } else {
	                            range = doc.createRange();
	                            range.setStart(sel.anchorNode, sel.anchorOffset);
	                            range.setEnd(sel.focusNode, sel.focusOffset);
	                        }

	                        return $('<div></div>').append(range.cloneContents()).html();
	                    }
	                } else if (doc.selection) {
	                    if (getText) {
	                        // get text
	                        return doc.selection.createRange().text;
	                    } else {
	                        // get html
	                        return doc.selection.createRange().htmlText;
	                    }
	                }
	            } catch (e) {
	                /* give up */
	            }

	            return '';
	        }
	    });

	    /* add selection */
	    $.fn.extend({
	        selection: function(mode, opts) {
	            opts = opts || {};

	            switch (mode) {
	                /**
	                 * selection('getPos')
	                 * get caret position
	                 *
	                 * @return  {Object}    return
	                 * @return  {Number}    return.start    start position for the selection
	                 * @return  {Number}    return.end      end position for the selection
	                 */
	                case 'getPos':
	                    return _CaretOperation.getPos(this[0]);

	                /**
	                 * selection('setPos', opts)
	                 * set caret position
	                 *
	                 * @param   {Number}    opts.start      start position for the selection
	                 * @param   {Number}    opts.end        end position for the selection
	                 */
	                case 'setPos':
	                    return this.each(function() {
	                        _CaretOperation.setPos(this, opts);
	                    });

	                /**
	                 * selection('replace', opts)
	                 * replace the selected text
	                 *
	                 * @param   {String}    opts.text            replacement text
	                 * @param   {String}    opts.caret           caret mode: any of the following: "keep" | "start" | "end"
	                 */
	                case 'replace':
	                    return this.each(function() {
	                        _CaretOperation.replace(this, opts.text, opts.caret);
	                    });

	                /**
	                 * selection('insert', opts)
	                 * insert before/after the selected text
	                 *
	                 * @param   {String}    opts.text            insertion text
	                 * @param   {String}    opts.caret           caret mode: any of the following: "keep" | "start" | "end"
	                 * @param   {String}    opts.mode            insertion mode: any of the following: "before" | "after"
	                 */
	                case 'insert':
	                    return this.each(function() {
	                        if (opts.mode === 'before') {
	                            _CaretOperation.insertBefore(this, opts.text, opts.caret);
	                        } else {
	                            _CaretOperation.insertAfter(this, opts.text, opts.caret);
	                        }
	                    });

	                /**
	                 * selection('get')
	                 * get selected text
	                 *
	                 * @return  {String}    return
	                 */
	                case 'get':
	                    /* falls through */
	                default:
	                    return _CaretOperation.getText(this[0]);
	            }

	            return this;
	        }
	    });
	})(jQuery, window, window.document);
	
	
	
	
	//コンストラクタ呼出し(クラス末尾にて定義すること）
	this.constract();
};