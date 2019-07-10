

$(()=>{
	
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

	// 入力ルールの定義
	var rules = {
		'last_name': {required: true, maxlength: 50},
		'first_name': {required: true, maxlength: 50},
		'last_name_kana': {required: true, katakana: true, maxlength: 50},
		'first_name_kana': {required: true, katakana: true, maxlength: 50},
		'email': {required: true, email: true},
		'password': {required: true,  minlength: 8, maxlength: 100, password_strength: true},
		'password_confirm': {equalTo: '[name=password]' },
		'tel': {required: true, phone: true},
		'post_code': {postcode: true},
		'address': {maxlength: 100},
		'gender': {required: true},
		'birthday': {date: true},
		'interests[]': {required: true},
		'plan': {required: true},
		
	};

	// 入力項目ごとのエラーメッセージ定義
	var messages = {
		'last_name': {
			required: "「氏」を入力してください"
		},
		'first_name': {
			required: "「名」を入力してください"
		},
		'interests[]': {
			required: "いずれかを選択してください"
		},
		password: {
			required: 'パスワードを入力してください',
			minlength: 'パスワードは8文字以上で入力してください',
		},
		password_confirm: {
			required: '確認のため再度入力してください',
			equalTo: '同じパスワードをもう一度入力してください。'
		}
	};
	
	$('#form1').validate({
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
	
});

function checkValid(){
	$res = $('#form1').valid();
	console.log($res);// true:すべてOK, false:一つ以上のエラーあり
}


