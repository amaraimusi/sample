/**
 * ★名称<br />
 *  フォーム自動入力ver2
 * ★概要
 *  フォームの入力内容をクッキーに保存。また保存したクッキーのデータをフォームに反映。<br />
 * 	フォームの入力内容をコンマ区切りで表示。また表示したデータをダイアログで入力することにより、フォームに反映<br />
 * ★参照
 * 　jquery.js
 * 　jquery.cookie.js
 * ★使い方
 * 　headerで当ファイルを、宣言するのみ。
 * ★履歴
 * 　2011/10/17 新規作成
 * 
 */

		$(window).load(function(){
		    // ページの読み込みが完了した後に実行するコード
			$obj=new AutoInpForm2();
			$obj.init();
			
		});

//フォーム自動入力クラス
var AutoInpForm2 =function(){
	
	var JOIN_STR='&&';
	var JOIN_STR2='::';
	
	//初期化。イベントのセッティング
	this.init=function() {

			//▼キーダウンイベント
			$(document).keydown(function(event){
	
		        //▽Ctrl＋F2　フォームの値をクッキーへ保存
		        if( event.shiftKey === false && event.ctrlKey === true && event.which === 113 ){
		        	
		            //$('#test').html('ctrlキーとF2が同時に押されました。');
		            
		            //すべてのinputエレメントから//inputデータ文字列を作成。
		            var ary=new Array();
		            $('input').each(
		        		function(){
		        			var type=$(this).attr("type");//type属性を取得する。
		        			if (type=='checkbox'){
			        			var str=$(this).attr("id")+JOIN_STR2+type.toLowerCase()+JOIN_STR2+$(this).attr('checked');
		        				
		        			}else if(type=='radio'){
		        				var str=$(this).attr("id")+JOIN_STR2+type.toLowerCase()+JOIN_STR2+$(this).attr('checked');
		        			}else{
			        			var str=$(this).attr("id")+JOIN_STR2+type.toLowerCase()+JOIN_STR2+$(this).val();
		        				
		        			}
		        			ary.push(str);
		        		}
		            );
		            $('textarea').each(
			        		function(){
			        			var type='textarea';
			        			var str=$(this).attr("id")+JOIN_STR2+type.toLowerCase()+JOIN_STR2+$(this).val();
			        			ary.push(str);
			        		}
			            );
		            $('select').each(
			        		function(){
			        			var type='select';
			        			var str=$(this).attr("id")+JOIN_STR2+type.toLowerCase()+JOIN_STR2+$(this).val();
			        			ary.push(str);
			        		}
			            );
		            var strData=ary.join(JOIN_STR);
		            
		            //現ページのURLをキーにして、inputデータ文字列をクッキーに保存
		            var url=location.href;
		            $.cookie(url,strData);

	                
		        }
		        
		        //▽F2　クッキーの値をフォームに反映。
		        if( event.shiftKey === false && event.ctrlKey === false && event.which === 113 ){

	                //$('#test').html('F2が押されました。');
	
		        	//現ページのURLを取得する。
	                var url=location.href;
	                
		        	//現ページURLをキーにして、クッキーからInputデータ文字列を取得する。
	                var strDataList=$.cookie(url);
	                
	                if(strDataList==null){
	                	return;
	                }

		        	//Inputデータ文字列を分解して、Inputデータリストを作成。
	                var data=strDataList.split(JOIN_STR);

		        	//inputデータリストの件数分、以下の処理を繰り返す。
	                for (var i=0;i<data.length;i++){
	                	var ent=data[i];
	                	
		        		//inputデータを「=」で分解して、idと値を取得する。
	                	var ary=ent.split(JOIN_STR2);
	                	var key=ary[0];//id属性を取得
	                	var type=ary[1];//type属性を取得
	                	var v=ary[2];//value属性を取得
	                	
		        		//IDに該当するエレメントに値をセットする。
	                	if(type=='checkbox'){
	                		if (v!='undefined' && v!=null){
		                		$('#'+key).attr('checked',v);
	                		}else{
	                			$('#'+key).removeAttr('checked');
	                		}
	                	}else if(type=='radio'){
	                		if (v!='undefined' && v!=null){
		                		$('#'+key).attr('checked',v);
	             
	                		}
	                		
	                	}else if(type=='textarea'){
		                	$('#'+key).val(v);//テキストエリア用
	                	}else{
		                	document.getElementById(key).value=v;//IDに[]が付属している場合にも対応。
	                	}
	                }
	                
		        	
		        }
		        
		        //▽Shift+F2 コンマデータ入力ダイアログ表示。
		        if( event.shiftKey === true && event.ctrlKey === false && event.which === 113 ){
	                //$('#test').html('ShiftキーとF2が同時に押されました。');
	                
	                
	                //現ページのURLを取得する。
	                var url=location.href;
	                
	                //URLをキーにクッキーからInputデータ文字列を表示する。
	                var strDataList=$.cookie(url);
	                
	                //入力ダイアログを表示する。その際、デフォルトテキストにInputデータ文字列をセット。
	                var rtn = window.prompt("FROMデータ文字列", strDataList);
	                
	                //返値がnullなら処理終了。
	                if(rtn==null){
		        
	                	return;
	                }

	                //
	                var data=rtn.split(JOIN_STR);
	                
		        	//inputデータリストの件数分、以下の処理を繰り返す。
	                for (var i=0;i<data.length;i++){
	                	var ent=data[i];
	                	
		        		//inputデータを「=」で分解して、idと値を取得する。
	                	var ary=ent.split(JOIN_STR2);
	                	var key=ary[0];//id属性を取得
	                	var type=ary[1];//type属性を取得
	                	var v=ary[2];//value属性を取得
	                	
		        		//IDに該当するエレメントに値をセットする。
	                	if(type=='checkbox'){
	                		if (v!='undefined' && v!=null){
		                		$('#'+key).attr('checked',v);
	                		}else{
	                			$('#'+key).removeAttr('checked');
	                		}
	                	}else if(type=='radio'){
	                		if (v!='undefined' && v!=null){
		                		$('#'+key).attr('checked',v);
	               
	                		}
	                		
	                	}else if(type=='textarea'){
		                	$('#'+key).val(v);//テキストエリア用
	                	}else{
		                	document.getElementById(key).value=v;//IDに[]が付属している場合にも対応。
	                	}
	                }

	        
		        }

			});
		
	};
	

};
 
