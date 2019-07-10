/*
 *
//バリデーションの記述例
var validates={
	0 :{//列番号ID。※番号に変数や定数を使わないように
		'notEmpty':{
			'msg':'IDは必須入力です。'},
		'maxLength':{
			'maxLen':4,
			'req':true,
			'msg':'IDは4文字以内で入力してください。'}
		},


	1 :{//列番号:名
		'maxLength':{
			'maxLen':7,
			'req':false,
			'msg':'名は7文字以内で入力してください。'}
		},


	3 :{//列番号:生年
		'numeric':{
			'req':false,
			'msg':'生年は数値を入力してください。'}
		},




	5 :{//列番号:活躍年
		'naturalNumber':{
			'req':false,
			'msg':'活躍年は自然数を入力してください。'}
		},

	6 :{//列番号:更新日
		'date':{
			'req':false,
			'msg':'更新日は日付で入力してください。'}
		},

	7 :{//範囲チェック
	'range':{
		'range1':800,
		'range2':1800,
		'req':true,
		'msg':'生年は800から1800の間で入力してください。'}
	},

	7 :{//半角英数字チェック
		'alphaNumeric':{
			'req':false,
			'symbol':true,//ハイフン、アンダースコアを許可する場合true
			'msg':'コードは半角英数字で入力してください。'}
		}
};
 */




/**
 * 入力チェッククラス A
 *
 * ★概要
 * エンティティや2次元配列の入力チェックに対応する。
 * Cake PHPと類似した仕様。
 *
 * ★履歴
 * 2009/7/9		新規作成
 * 2009/7/17	大量追加
 * 2010/09/27	拡張版関数を追加。
 * 2013/09/10	ファイル名をinput_check_exからinput_check_mat.jsに変更する。
 * 2014/6/2		input_check_mat.jsからinput_check_aに変更。クラス化。エンティティ、2次元配列に対応。
 * 2014/7/1		dateに対応
 * 2014/7/7		checkEntityメソッド：連想配列にも対応
 * 2014/7/24	rangeに対応
 *
 */
var InputCheckA =function(){


	/**
	 * エンティティの入力チェック
	 * ※連想配列のエンティティにも対応
	 *
	 * ★対応
	 * notEmpty			必須チェック
	 * maxLength		文字数チェック
	 * numeric			数字チェック
	 * naturalNumber	自然数チェック
	 * date				日付チェック
	 *
	 * ×未対応
	 * range
	 *
	 *
	 * @param ent		エンティティ（2次元配列）
	 * @param validates	バリデーションリスト
	 * @return Array	エラーメッセージリスト。正常の場合、null
	 */
	this.checkEntity=function(ent,validates){

		//連想配列（オブジェクト）である場合、配列に変換する。
		if(ent instanceof Array){

		}else{
			var ary=new Array();
			for(var k in ent){
				var v=ent[k];
				ary.push(v);
			}
			ent=ary;
		}

		var errs=new Array();

		for(var i=0;i<ent.length;i++){
			var v=ent[i];
			var vld=validates[i];

			if(vld!=undefined){
				var msg=this.checkEntity_(v,vld);//★エンティティ入力チェック２

				if(msg != ''){

					errs.push(msg);
				}
			}
		}


		if(errs.length==0){
			return null;
		}

		return errs;
	}
	/**
	 * エンティティの入力チェックその２
	 * @param v	値
	 * @param vld	バリデーション情報
	 * @param string	エラーメッセージ。正常の場合、空文字。
	 */
	this.checkEntity_=function(v,vld){


		//必須チェック
		if(vld['notEmpty']!=undefined){

			var ary=vld['notEmpty']
			var msg=ary['message'];

			//エイリアスなプロパティをセット
			if(msg==undefined){
				msg=ary['msg'];
			}

			//★必須チェック
			msg=this.reqEx(v,msg);

			if(msg != ''){
				return msg;
			}
		}

		//文字数チェック
		if(vld['maxLength']!=undefined){

			var ary=vld['maxLength']
			var maxLen=ary['maxLength'];
			var msg=ary['message'];
			var req=ary['allowEmpty'];

			//エイリアスなプロパティをセット
			if(maxLen==undefined){
				maxLen=ary['maxLen'];
			}
			if(msg==undefined){
				msg=ary['msg'];
			}
			if(req==undefined){
				req=ary['req'];
			}

			//★文字数チェック
			msg=this.maxLengthEx(v,maxLen,req,msg);

			if(msg != ''){
				return msg;
			}
		}

		//数値チェック
		if(vld['numeric']!=undefined){

			var ary=vld['numeric']
			var msg=ary['message'];
			var req=ary['allowEmpty'];

			//エイリアスなプロパティをセット
			if(msg==undefined){
				msg=ary['msg'];
			}
			if(req==undefined){
				req=ary['req'];
			}

			//★数値チェック
			msg=this.isNumEx(v,req,msg);

			if(msg != ''){
				return msg;
			}
		}

		//自然数チェック
		if(vld['naturalNumber']!=undefined){

			var ary=vld['naturalNumber']
			var msg=ary['message'];
			var req=ary['allowEmpty'];

			//エイリアスなプロパティをセット
			if(msg==undefined){
				msg=ary['msg'];
			}
			if(req==undefined){
				req=ary['req'];
			}

			//★自然数チェック
			msg=this.isNaturalNumberEx(v,req,msg);

			if(msg != ''){
				return msg;
			}
		}

		//日付チェック
		if(vld['date']!=undefined){

			var ary=vld['date']
			var msg=ary['message'];
			var req=ary['allowEmpty'];

			//エイリアスなプロパティをセット
			if(msg==undefined){
				msg=ary['msg'];
			}
			if(req==undefined){
				req=ary['req'];
			}

			//★日付チェック
			msg=this.isDateEx(v,req,msg);

			if(msg != ''){
				return msg;
			}
		}


		//数値範囲チェック
		if(vld['range']!=undefined){

			var ary=vld['range']
			var range1=ary['range1'];
			var range2=ary['range2'];
			var msg=ary['message'];
			var req=ary['allowEmpty'];

			//エイリアスなプロパティをセット
			if(msg==undefined){
				msg=ary['msg'];
			}
			if(req==undefined){
				req=ary['req'];
			}

			//★数値範囲チェック
			msg=this.rangeEx(v,range1,range2,req,msg);

			if(msg != ''){
				return msg;
			}
		}

		//半角英数字チェック
		if(vld['alphaNumeric']!=undefined){

			var ary=vld['alphaNumeric']
			var symbol=ary['symbol'];
			var msg=ary['message'];
			var req=ary['allowEmpty'];

			//エイリアスなプロパティをセット
			if(msg==undefined){
				msg=ary['msg'];
			}
			if(req==undefined){
				req=ary['req'];
			}

			//★半角英数字チェック
			msg=this.alphaNumericEx(v,symbol,req,msg);

			if(msg != ''){
				return msg;
			}
		}





		return msg;

	}

	/**
	 * 2次元配列をチェックする。
	 * 最初に見つかった1行分のエラーのみ返す。
	 * @param data		2次元配列データ
	 * @param validates	バリデーションリスト
	 * @return Array	エラーメッセージリスト。正常の場合、null
	 *
	 */
	this.checkData=function(data,validates){

		var errs=null;
		for(var i=0;i<data.length;i++){
			var ent=data[i];
			var errs=this.checkEntity(ent, validates);
			if(errs !=null){
				var rowNo=i+1;
				var msg=rowNo + "行目";
				errs.unshift(msg);
				break;
			}
		}

		return errs;
	}


	/**
	 * 文字数チェック
	 * @param v			チェック文字列
	 * @param maxLen	制限文字数
	 * @param req		trueは必須入力。0と半角SPは入力ありとみなす。引数省略時はfalse
	 * @param msg		入力エラーのときのメッセージ
	 * @return			入力エラーがあれば引数のメッセージを返す。正常の場合は空文字を返す。
	 *
	 *
	 */
	this.maxLengthEx=function(v,maxLen,req,msg){

		if(this.maxLength(v,maxLen,req)==false){
			if(this.is_ari(msg)){
				return msg;
			}else{
				return maxLen + '文字以内で入力してください';
			}

		}

		return '';
	}

	/**
	 * 必須チェック（0はOK)
	 * @param v			チェック文字列
	 * @param msg		入力エラーのときのメッセージ
	 * @return			入力エラーがあれば引数のメッセージを返す。正常の場合は空文字を返す。
	 *
	 *
	 */
	this.reqEx=function(v,msg){

		if(this.is_ari_quam0(v)==false){
			if(this.is_ari(msg)){
				return msg;
			}else{
				return '必須入力です。';
			}

		}

		return '';
	}


	/**
	 * 小数点、負値を含む数値であることをチェックする。
	 * @param v			チェック文字列
	 * @param msg		入力エラーのときのメッセージ
	 * @return			入力エラーがあれば引数のメッセージを返す。正常の場合は空文字を返す。
	 */
	this.isNumEx=function(v,req,msg){

		//必須入力チェック
		if(this.is_ari(req)==true){
			if(this.is_ari_quam0(v)==false){
				if(this.is_ari(msg)){
					return msg;
				}else{
					return '必須入力です。';
				}
			}
		}

		//数値チェックをする。
		if(isNaN(v)){
			if(this.is_ari(msg)){
				return msg;
			}else{
				return '数値を入力してください。';
			}
		}

		return '';

	}


	/**
	 * 自然数チェック
	 * @param v			チェック文字列
	 * @param msg		入力エラーのときのメッセージ
	 * @return			入力エラーがあれば引数のメッセージを返す。正常の場合は空文字を返す。
	 */
	this.isNaturalNumberEx=function(v,req,msg){

		//必須入力チェック
		if(this.is_ari(req)==true){
			if(this.is_ari_quam0(v)==false){
				if(this.is_ari(msg)){
					return msg;
				}else{
					return '必須入力です。';
				}
			}
		}

		//自然数チェックをする。
		if(this.isNaturalNumber(v)==false){
			if(this.is_ari(msg)){
				return msg;
			}else{
				return '自然数を入力してください。';
			}
		}

		return '';

	}






	/**
	 * 日付チェック
	 * @param v			チェック文字列
	 * @param msg		入力エラーのときのメッセージ
	 * @return			入力エラーがあれば引数のメッセージを返す。正常の場合は空文字を返す。
	 */
	this.isDateEx=function(v,req,msg){

		//必須入力チェック
		if(this.is_ari(req)==true){
			if(this.is_ari_quam0(v)==false){
				if(this.is_ari(msg)){
					return msg;
				}else{
					return '必須入力です。';
				}
			}
		}

		//日付チェックをする。
		if(this.isDate(v)==false){
			if(this.is_ari(msg)){
				return msg;
			}else{
				return '自然数を入力してください。';
			}
		}

		return '';

	}


	/**
	 * 数値範囲チェック
	 * @param v			チェック文字列
	 * @param range1	範囲1
	 * @param range2	範囲2
	 * @param req		trueは必須入力。0と半角SPは入力ありとみなす。引数省略時はfalse
	 * @param msg		入力エラーのときのメッセージ
	 * @return			入力エラーがあれば引数のメッセージを返す。正常の場合は空文字を返す。
	 *
	 *
	 */
	this.rangeEx=function(v,range1,range2,req,msg){

		if(this.range(v,range1,range2,req)==false){
			if(this.is_ari(msg)){
				return msg;
			}else{
				return range1 + '～' + range2 + 'の範囲で入力してください。';
			}

		}

		return '';
	}





	/**
	 * 半角英数字チェック
	 * @param v			チェック文字列
	 * @param symbol	ハイフンとアンダースコアも許可する場合true
	 * @param req		trueは必須入力。0と半角SPは入力ありとみなす。引数省略時はfalse
	 * @param msg		入力エラーのときのメッセージ
	 * @return			入力エラーがあれば引数のメッセージを返す。正常の場合は空文字を返す。
	 *
	 *
	 */
	this.alphaNumericEx=function(v,symbol,req,msg){

		if(this.is_alpha_numeric(v,symbol,req)==false){
			if(this.is_ari(msg)){
				return msg;
			}else{
				return '半角英数字で入力してください。';
			}

		}

		return '';
	}

















	/**
	 * 文字数チェック
	 * @param v			チェック文字列
	 * @param maxLen	制限文字数
	 * @param req		trueは必須入力。0と半角SPは入力ありとみなす。引数省略時はfalse
	 *
	 */
	this.maxLength=function(v,maxLen,req){


		//必須入力チェック
		if(this.is_ari(req)==true){
			if(this.is_ari_quam0(v)==false){
				return false;
			}
		}


		//最大文字数チェックをする。
		var n=v.length;
		if (n > maxLen){
			return false;

		}

		return true;
	}



	//空白系であればfalseを返す。空文字系→ undefined,空文字「''」,null,0,false
	this.is_ari=function(v){
		if(v == null || v == ''){
			return false;
		}else{
			return true;
		}
	}

	//0以外の空白系はfalse(undefined,空文字「''」,null,false)
	this.is_ari_quam0=function(v){
		if(v == null || v === '' || v === false){
			return false;
		}else{
			return true;
		}
	}



	//空白系であればtrueを返す。空文字系→ undefined,空文字「''」,null,0,false
	this.is_nai=function(v){
		if(v == null || v == ''){
			return true;
		}else{
			return false;
		}
	}

	//0以外の空白系はtrue(undefined,空文字「''」,null,false)
	this.is_nai_quam0=function(v){
		if(v == null || v === '' || v === false){
			return true;
		}else{
			return false;
		}
	}


	// 自然数のチェック
	this.isNaturalNumber=function(num){

	    if (num.match(/[^0-9]/g)) {

	        return false;
	    }

	    return true;
	}


	//日付チェック(yyyy/mm/dd型とyyyy-mm-dd型に対応）
	this.isDate=function(d){
		var sp="/";
		if(d.split("/").length != 3){
			if(d.split("-").length != 3){
				return false;
			}else{
				sp="-";
			}
		}
		var date = new Date(d);
		if(d == (date.getFullYear() + sp + (date.getMonth() + 1) + sp + date.getDate())){
			return true;
		}else{
			return false;
		}
	}


	/**
	 * 数値範囲チェック
	 * @param v			チェック文字列
	 * @param range1	範囲1
	 * @param range2	範囲2
	 * @param req		trueは必須入力。0と半角SPは入力ありとみなす。引数省略時はfalse
	 *
	 */
	this.range=function(v,range1,range2,req){


		//必須入力チェック
		if(this.is_ari(req)==true){
			if(this.is_ari_quam0(v)==false){
				return false;
			}
		}


		//数値チェックをする。
		if(isNaN(v)){
			return false;
		}

		//数値範囲チェックをする。
		if(range1 <= v && range2 >= v){
			return true;
		}else{
			return false;
		}


	}


	/**
	 * 半角英数字チェック
	 * @param v			チェック文字列
	 * @param symbol	ハイフン、アンダースコアを許可する場合はtrue
	 * @param req		trueは必須入力。0と半角SPは入力ありとみなす。引数省略時はfalse
	 *
	 */
	this.is_alpha_numeric=function(v,symbol,req){


//		//必須入力チェック。必須フラグがtrueで値が空ならfalse
//		if(this.is_ari(req)==true){
//			if(this.is_ari_quam0(v)==false){
//				return false;
//			}
//		}else{
//			if(this.is_ari_quam0(v)==false){
//				return false;
//			}
//
//		}

		var flg=false;

		if(symbol==true){
			//半角英数字チェック。ハイフンとアンダースコアも許可
			flg= /^[a-zA-Z0-9_\-]+$/.test(v);

		}else{

			//半角英数字チェック
			flg= /^[a-zA-Z0-9]+$/.test(v);
		}

		//結果がfalse,必須フラグがfalse,値が空ならtrueを返す。
		if(flg==false){
			if(this.is_ari(req)==false){
				if(this.is_ari_quam0(v)==false){
					flg=true;
				}
			}
		}

		return flg;



	}








};