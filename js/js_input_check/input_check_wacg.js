/**
 *☆名称
 *汎用入力チェック。
 *☆概要
 *入力チェックを行う。
 *☆履歴
 *2013/03/03	新規作成。
 *2013/03/13	Eメール入力チェック、半角数値入力チェックを作成。
 *2013/03/18	半角英数字チェックを追加。いくつかの関数で空値はtrueを返すように変更。
 *2013/03/29	半角記号入力チェックを追加。
 *2015/08/21	ic_date関数はバグがあるので廃止し、代わりにisDate関数を作成
 *
 */






/**
 * 必須入力チェック。拡張版。
 * エラーがあった場合、エラー用DOMにエラーメッセージを表示する。
 * @param v			チェック対象値
 * @param errMsgSlt	エラーメッセージを表示するJQueryセレクタ
 * @return			正常であればtrueを返し、異常があればエラーメッセージを返す。
 */
function ic_requiredEx(v,errMsgSlt){

	var ret=ic_required(v);
	if(ret!=true){
		errMsgSlt.html('必須入力です。');
	}else{
		errMsgSlt.html('');
	}
	return ret;
}
/**必須入力チェック
 * @param v チェック対象値
 * @return 正常であればtrueを返し、異常があればfalseを返す。
 */
function ic_required(v){

	var flg=false;
	if(v!=null){
		if(v.trim()!=''){
			return true;
		}
	}

	return false;

}

/**
 * 最大文字数入力チェック。拡張版。
 * エラーがあった場合、エラー用DOMにエラーメッセージを表示する。
 * @param v			チェック対象値
 * @param maxLen	最大文字数。
 * @param errMsgSlt	エラーメッセージを表示するJQueryセレクタ
 * @return			正常であればtrueを返し、異常があればエラーメッセージを返す。
 */
function ic_maxlengthEx(v,maxLen,errMsgSlt){


	var ret=ic_maxlength(v,maxLen);
	if(ret!=true){
		errMsgSlt.html('入力文字数は'+maxLen+'文字以内で入力してください');
	}else{
		errMsgSlt.html('');
	}
	return ret;
}

function ic_maxlength(v,maxLen){
	//最大文字数チェックをする。
	if (v.length>maxLen){
		return false;
	}else{
		return true;
	}

}


//半角数値チェック。拡張版
function ic_numEx(v,errMsgSlt){
	var ret=ic_num(v);
	if(ret==true){
		errMsgSlt.html('');
	}else{
		errMsgSlt.html('半角数値で入力してください。');
	}
	return ret;
}
//半角数値入力チェック。
function ic_num(v){
	if(v==null || v==''){//空値はtrueを返す。
		return true;
	}
	if (v.match(/^[0-9]+$/)){

		return true;
	}else{
		return false;
	}
}

//半角英数字チェック。拡張版
function ic_hanAlfNumEx(v,errMsgSlt){

	var ret=ic_hanAlfNum(v);
	if(ret==true){
		errMsgSlt.html('');
	}else{
		errMsgSlt.html('半角英数字で入力してください。');
	}
	return ret;
}
//半角英数字入力チェック。
function ic_hanAlfNum(v){
	if(v==null || v==''){//空値はtrueを返す。
		return true;
	}
	if (v.match(/^[a-zA-Z0-9]+$/)){

		return true;
	}else{
		return false;
	}
}



//Eメール入力チェック拡張版
function ic_mailEx(v,errMsgSlt){
	var ret=ic_mail(v);
	if(ret==true){
		errMsgSlt.html('');
	}else{
		errMsgSlt.html('Eメールの書式を入力してください。');
	}
	return ret;
}
//Eメール入力チェック
function ic_mail(v){
	if(v==null || v==''){//空値はtrueを返す。
		return true;
	}
	if (v.match(/^[A-Za-z0-9]+[\w-]+@[\w\.-]+\.\w{2,}$/)){

		return true;
	}else{
		return false;
	}
}






//記号入力チェック拡張版
function ic_markEx(v,errMsgSlt){
	var ret=ic_mark(v);
	if(ret==true){
		errMsgSlt.html('');
	}else{
		errMsgSlt.html('半角記号は入力できません。');
	}
	return ret;
}

//記号入力チェック
function ic_mark(v){
	if(v==null || v==''){//空値はtrueを返す。
		return true;
	}
	if (v.match(/[!"#$%&\'()=~|`{+*}<>?_\-\^\\@\[;:\],.\/]/)){

		return false;
	}else{
		return true;
	}
}

/**
 * 日付チェック
 * yyyy/mm/dd形式とyyyy-mm-dd形式に対応
 * 閏年に対応
 * @param value
 * @returns true:入力OK    false:入力エラー
 */
function isDate(value){

	var ary=value.split("/");
	if(ary.length != 3){
		ary=value.split("-");
		if(ary.length != 3){
			return false;;
		}
	}

	var y=parseInt(ary[0]);
	var m=parseInt(ary[1]);
	var d=parseInt(ary[2]);

	var dt=new Date(y,m-1,d);
	if(dt.getFullYear()!=y || dt.getMonth()!=m-1 || dt.getDate()!=d){
		return false;
	}
	return true;
}












