/**
 * メンバー登録フォーム 
 * @date 2019-3-7 新規作成
 * @version 1.0.0
 */

var vueApp; // vue.js
var m_stepElms = {}; // ステップ要素リスト

jQuery(() => {
	
	// ▼ Vue.jsの初期設定
	vueApp = new Vue({
		el: '#app1',
		data: {
			email: '',
			password: '',
			last_name: '',
			first_name: '',
			last_name_kana: '',
			first_name_kana: '',
			tel: '',
			post_code: '',
			address: '',
			birthday: '',
			interests: [false, false, false, false, false],
			interestData:[
				{text:'釣り', value:1, xid:'interest1'},
				{text:'登山', value:2, xid:'interest2'},
				{text:'料理', value:3, xid:'interest3'},
				{text:'ゲーム', value:4, xid:'interest4'},
				{text:'その他', value:5, xid:'interest5'},
			],
			plan: '',
			planList:{
				'100': '猫観光ツアープラン',
				'101': '登山ガイド',
				'102': '遺跡ツアー',
				'104': '食べ歩きツアー',
			}
		}
	});
	
	// jquery.validate.min.jsの拡張
	_exJQueryValidator();
	
	// ▼ バリデーションの初期化
	_initValid('step1');
	_initValid('step2');
	_initValid('step3');
	
	// ステップ要素リストを取得する
	m_stepElms = _getStepElms(['#step1', '#step2', '#step3', '#step4', '#step5']);
	
	_showStep('#step1');// step1を表示
	

	
	
});


/**
 * バリデーションの初期化
 * @param string step_name ステップ名
 */
function _initValid(step_name){
	
	var rules; // バリデーションルール
	var messages; // バリデーションのエラーメッセージ（固有指定用）
	
	// ▼ ステップごとの入力ルールの定義
	switch(step_name){
	case 'step1':
		rules = {
			'email': {required: true, email: true},
			'password': {required: true,  minlength: 8, maxlength: 100, password_strength: true},
			'password_confirm': {equalTo: '[name=password]' },
		};
		
		// 入力項目ごとのエラーメッセージ定義
		messages = {
			password: {
				required: 'パスワードを入力してください',
				minlength: 'パスワードは8文字以上で入力してください',
			},
			password_confirm: {
				required: '確認のため再度入力してください',
				equalTo: '同じパスワードをもう一度入力してください。'
			}
		};
		
		break;
		
	case 'step2':
		rules = {
			'last_name': {required: true, maxlength: 50},
			'first_name': {required: true, maxlength: 50},
			'last_name_kana': {required: true, katakana: true, maxlength: 50},
			'first_name_kana': {required: true, katakana: true, maxlength: 50},
			'tel': {required: true, phone: true},
			'post_code': {postcode: true},
			'address': {maxlength: 100},
			'gender': {required: true},
		};
		
		// 入力項目ごとのエラーメッセージ定義
		messages = {
			'last_name': {
				required: "「氏」を入力してください"
			},
			'first_name': {
				required: "「名」を入力してください"
			},
		};
		break;
	case 'step3':
		rules = {
			'interests[]': {required: true},
			'plan': {required: true},
		};
		break;
	default:
		return;
	}
	
	var form_slt = '#form_' + step_name;
	
	$(form_slt).validate({
		rules: rules,
		messages: messages,

		//エラーメッセージ出力箇所を調整
		errorPlacement: function(error, element){
			if (element.is(':radio')) {
				error.appendTo(element.parent());
			}else if (element.is(':checkbox')) {
				error.appendTo(element.parent());
			}else {
				error.insertAfter(element);
			}
		}
	});
	
}


/**
 * STEP1の「次へ」ボタンを押下
 */
function nextBtnForStep1(){

	var valid_res = $('#form_step1').valid();
	
	if(!valid_res) return;

	// ▼ メールアドレス登録済みチェック 
	var errElm = jQuery('#err_step1');
	errElm.hide();
	_checkRegistered((registered)=>{
		if(registered){
			errElm.html('すでに登録済みのメールアドレスです。');
			errElm.show();
		}else{
			_showStep('#step2');// step1を表示
		}
	});
	
}


/**
 * メールアドレス登録済みチェック 
 * @param function チェック後コールバック
 */
function _checkRegistered(afterCallback){

	var sendData = {
			email: vueApp.email
	};
	var send_json = JSON.stringify(sendData);//データをJSON文字列にする。
	var ajax_url = 'check_registered.php';

	// AJAX
	jQuery.ajax({
		type: "POST",
		url: ajax_url,
		data: "key1=" + send_json,
		cache: false,
		dataType: "text",
	})
	.done((res_json, type) => {
		var res;
		try{
			res =jQuery.parseJSON(res_json);//パース
			
		}catch(e){
			jQuery("#err").append(res_json);
			console.log(res_json);
			return;
		}
		
		// コールバックを実行
		afterCallback(res.registered)
		
	})
	.fail((jqXHR, statusText, errorThrown) => {
		jQuery('#err').append('アクセスエラー');
		jQuery('#err').append(jqXHR.responseText);
		alert(statusText);
	});
}


/**
 * STEP2の「次へ」ボタンを押下
 */
function nextBtnForStep2(){

	var valid_res = $('#form_step2').valid();
	
	if(valid_res){
		_showStep('#step3');// step3を表示
	}

}

/**
 * STEP2の「戻る」ボタン押下
 */
function returnBtnForStep2(){
	_showStep('#step1');// step1を表示
}

/**
 * STEP3の「次へ」ボタン押下
 */
function nextBtnForStep3(){
	var valid_res = $('#form_step3').valid();
	
	if(valid_res){
		_showStep('#step4');
	}
}


/**
 * STEP3の「戻る」ボタン押下
 */
function returnBtnForStep3(){
	_showStep('#step2');// step1を表示
}


/**
 * STEP3の「戻る」ボタン押下
 */
function returnBtnForStep4(){
	_showStep('#step3');// step1を表示
}


/**
 * 登録
 * @returns
 */
function reg(){
	
	// 登録済みチェック
	var errElm = jQuery('#err_step4');
	errElm.hide();
	_checkRegistered((registered)=>{
		if(registered){
			errElm.html('すでに登録済みのメールアドレスです。');
			errElm.show();
		}else{
			_reg2();
		}
	});
}

/**
 * 登録2
 */
function _reg2(){
	
	// Ajaxによる登録
	_regByAjax(()=>{
		_showStep('#step5');// step1を表示
	});
	
}


/**
 * Ajaxによる登録
 * @param function 登録後コールバック
 */
function _regByAjax(afterCallback){
	
	var sendData = {};
	
	// ▼ vue.jsで管理している全データをsendDataに詰めなおす
	for(var key in vueApp._data){
		sendData[key] = vueApp._data[key];
	}
	
	var send_json = JSON.stringify(sendData);//データをJSON文字列にする。
	var ajax_url = 'reg.php';

	// AJAX
	jQuery.ajax({
		type: "POST",
		url: ajax_url,
		data: "key1=" + send_json,
		cache: false,
		dataType: "text",
	})
	.done((res_json, type) => {
		var res;
		try{
			res =jQuery.parseJSON(res_json);//パース
			
		}catch(e){
			jQuery("#err").append(res_json);
			console.log(res_json);
			return;
		}
		
		// コールバックを実行
		afterCallback(res.registered)
		
	})
	.fail((jqXHR, statusText, errorThrown) => {
		jQuery('#err').append('アクセスエラー');
		jQuery('#err').append(jqXHR.responseText);
		alert(statusText);
	});
}


/**
 * 指定したステップ区分を表示する
 * @param xid 指定ステップ区分のID属性
 */
function _showStep(xid){

	for(var i in m_stepElms){
		var stepElm = m_stepElms[i];
		stepElm.hide();
	}
	m_stepElms[xid].show();
	
	
}


/**
 * ステップ要素リストを取得する
 * @param stepXids ステップID属性リスト
 * @returns object ステップ要素リスト
 */
function _getStepElms(stepXids){
	var stepElms = {};
	for(var i in stepXids ){
		var xid = stepXids[i];
		var elm = jQuery(xid);
		if(elm[0]){
			stepElms[xid] = elm;
		}
	}
	return stepElms;
}

/**
 * jquery.validate.min.jsの拡張
 * @returns
 */
function _exJQueryValidator(){
	// 標準エラーメッセージの変更
	$.extend($.validator.messages, {
		email: '正しいメールアドレスの形式で入力して下さい',
		required: '入力必須です',
		phone: "正しい電話番号の形式で入力してください",
	});

	// 独自ルールを追加
	jQuery.validator.addMethod("katakana", function(value, element) {
			return this.optional(element) || /^([ァ-ヶー]+)$/.test(value);
		}, "全角カタカナを入力してください"
	);
	jQuery.validator.addMethod("kana", function(value, element) {
			return this.optional(element) || /^([ァ-ヶーぁ-ん]+)$/.test(value);
		}, "全角ひらがな･カタカナを入力してください"
	);
	jQuery.validator.addMethod("hiragana", function(value, element) {
			return this.optional(element) || /^([ぁ-ん]+)$/.test(value);
		}, "全角ひらがなを入力してください"
	);
	jQuery.validator.addMethod("phone", function(value, element) {
			return this.optional(element) || /^(?:\+?\d+-)?\d+(?:-\d+){2}$|^\+?\d+$/.test(value);
		}, "正しい電話番号を入力してください"
	);
	jQuery.validator.addMethod("postcode", function(value, element) {
			return this.optional(element) || /^\d{3}\-?\d{4}$/.test(value);
		}, "郵便番号を入力してください（例:123-4567）"
	);
	jQuery.validator.addMethod("password_strength", function(value, element) {
			return this.optional(element) || /^(?=.*?[a-z])(?=.*?\d)[a-z\d]{6,100}$/.test(value);
		}, "英数字を組み合わせたパスワードを入力してください"
	);
}


/**
 * テストデータを入力
 */
function testDataInput(){
	
	_setValueToInputByName('email', 'example.123@example.net');
	_setValueToInputByName('password', 'abcd1234');
	_setValueToInputByName('password_confirm', 'abcd1234');
	_setValueToInputByName('last_name', '山原');
	_setValueToInputByName('first_name', '九稲');
	_setValueToInputByName('last_name_kana', 'ヤンバル');
	_setValueToInputByName('first_name_kana', 'クイナ');
	_setValueToInputByName('tel', '+81-90-0123-4567');
	_setValueToInputByName('post_code', '123-4567');
	_setValueToInputByName('address', '沖縄県国頭郡奥　123-4  天然記念物マンション 999号室');
	_setValueToInputByName('birthday', '2012-12-12');
	
}



/**
 * Vue.jsとjQueryの連動を保ちつつ、値をinput要素にセットする。
 * @param string x_name name属性
 * @param mixed value 値
 */
function _setValueToInputByName(x_name, value){
	
	var slt = `input[name='${x_name}']`;
	_setValueToInputVJ(slt, value);
	
}



/**
 * Vue.jsとjQueryの連動を保ちつつ、値をinput要素にセットする。
 * @param mixed jqElm jQuery要素、もしくはセレクタ
 * @param mixed value 値
 */
function _setValueToInputVJ(jqElm, value){
	if(typeof jqElm == 'string') jqElm = jQuery(jqElm);
	
	if(jqElm[0]){
		jqElm.val(value);
		jqElm[0].dispatchEvent(new Event('input')); // vue.js側に変更をイベント発信する
	}
	
}


