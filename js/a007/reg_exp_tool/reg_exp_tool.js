/**
 * 正規表現ツール
 * @date 2018-4-22
 * @version 1.0
 */

var regExpTool;

$(()=>{
	regExpTool = new RegExpTool();
});

/**
 * 正規表現ＳＥＬＥＣＴのチェンジイベント
 */
function changeReSel(){
	regExpTool.changeReSel();
}

/**
 * テスト実行
 */
function testExe(){
	regExpTool.testExe();
}

/**
 * テスト実行 Htmlの正規表現
 */
function testExeH(){
	regExpTool.testExeH();
}




/**
 * 正規表現ツールクラス
 */
class RegExpTool{
	
	
	constructor(){
		
		// 検証データ
		this.data = [
			'1234',
			'+1001',
			'-1002',
			'-12.345',
			'+12.345',
			'A12.345',
			'12.345Z',
			'0',
			'1',
			'0.0',
			'-0',
			'-0.0',
			'0123',
			'1+1',
			'abcd',
			'あいうえおx/y\z9aabbc123',
			'2018-4-22',
			'',
		];
		
		// 正規表現データ
		this.reData = [
			{'reg_exp':'\\d{1}$','note':'末尾一文字の数字'},
			{'reg_exp':'\\d+','note':'最初に現れる数字列'},
			{'reg_exp':'^[0-9]+$','note':'自然数'},
			{'reg_exp':'^[+-]?[0-9]+$','note':'整数'},
			{'reg_exp':'^[+-]?([0-9]*[.])?[0-9]+$','note':'浮動小数点'},
			{'reg_exp':'あ','note':''},
		];
		
		// 正規表現データセレクトの初期化
		this.initRegSelect(this.reData);
	}
	
	
	/**
	 * 正規表現ＳＥＬＥＣＴのチェンジイベント
	 */
	changeReSel(){

		// 正規表現文字列を取得する
		var re_var = $('#re_sel').val();
		var re_str = this.reData[re_var]['reg_exp'];
		
		// 正規表現テキストボックスにセットする
		$('#re_text').val(re_str);
		
		// HTML正規表現用のセット
		$('#re_text_h').val(re_str);
		
	}
	
	
	/**
	 * テスト実行
	 */
	testExe(){

		var re_str = $('#re_text').val();

		var trs_str = "";
		for(var i in this.data){
			var str1 = this.data[i];
			
			var res = str1.match(re_str);
			
			var res_str = null;
			if(res){
				res_str = res[0];
			}
			
			var trs_str = trs_str + "<tr><td>" + str1 + 
			"</td><td>" + res_str + 
			"</td></tr>";
			
		}
		$('#res_tbl tbody').html(trs_str);;

	}
	
	
	
	/**
	 * 正規表現データセレクトの初期化
	 * 
	 */
	initRegSelect(reData){
		
		
		var list = [];
		for(var i in reData){
			var ent = reData[i];
			var reg_exp = ent.reg_exp;
			reg_exp = reg_exp.replace("\\","\\\\");
			var row_str = reg_exp + ' ■ ' + ent.note;
			list.push(row_str);
		}
		
		var reSelElm = $('#re_sel');
		this.setSelectOption(reSelElm,list);
	}
	
	
	/**
	 * SELECTのオプション要素にリストの値をセットする
	 * @param selElm SELECT要素
	 * @param list  リスト。 リストの構造→ [キー] = テキスト
	 * @parma value 始めの選択値【省略可】
	 * @parma empty_text 空選択肢のテキスト【省略可】
	 */
	setSelectOption(selElm,list,value,empty_text){
		
		var ops_str='';
		
		if(empty_text){
			ops_str = "<option value=''>" + empty_text + "</option>¥n"
		}
		
		for(var i in list){
			var text = list[i];
			
			var selected = '';
			if(i == value){
				selected = 'selected';
			}
			ops_str += "<option value='" + i + "' " + selected + ">" + 
				text + "</option>";
		}
		
		selElm.html(ops_str);
		
	}
	
	
	/**
	 * テスト実行 正規表現
	 */
	testExeH(){
		
		var rs_str = $('#re_text_h').val();
		
		var elm = $('#inp_h');
		//elm.attr('pattern','^[0-9]+$');
		elm.attr('pattern',rs_str);
		
		var valid = elm[0].checkValidity();
		
		if(valid == true){
			alert('入力ＯＫ');
		}else{
			alert('バリデーション！！');
		}		
	}
	
	
}
