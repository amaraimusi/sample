

var cbAsynsEnd; // 複数非同期・全終了後コールバック・データ

function test1(){
	
	output('スタート');
	
	var asyns_cnt = 5; // 非同期処理の件数
	
	// 複数非同期・全終了後コールバック・初期化
	_cbAsynsEndInit(asyns_cnt,()=>{
		// 複数非同期・全終了後コールバック
		output('すべての非同期処理が終わりました。');
	})
	
	for(var i=0;i<asyns_cnt;i++){
		var t = Math.random() * 1000;
		
		window.setTimeout(() => {
			output('コールバック');

			_cbAsynsEndAction(); // 複数の非同期処理がすべて終了したらコールバックを実行する。
		},t);
	}
	
}


/**
 * 複数非同期・全終了後コールバック・初期化
 * @param int count 非同期処理の件数
 * @param function callback プレビュー後コールバック
 */
function _cbAsynsEndInit(count,callback){

	this.cbAsynsEndData = {
		'index':0,
		'count':count,
		'callback':callback,
	};
	
}

/**
 * 複数非同期・全終了後コールバック
 * @note
 * 複数の非同期処理がすべて終了したらコールバックを実行する。
 * 
 * @param string action アクションコード
 *  - exe1 非同期処理がすべて終了したらコールバック関数を実行する。(デフォルト)
 *  - exe2 非同期処理が0件であるならコールバック関数を実行する。
 */
function _cbAsynsEndAction(action){
	
	if(action == null) action = 'exe1';
	
	switch (action) {
	case 'exe1':

		var cbAsynsEndData = this.cbAsynsEndData;
		if(cbAsynsEndData.callback == null || cbAsynsEndData.count == 0) return;
		if(cbAsynsEndData.index == cbAsynsEndData.count -1){
			cbAsynsEndData.callback();
		}else{
			cbAsynsEndData.index ++;
		}
		break;

	case 'exe2':

		var cbAsynsEndData = this.cbAsynsEndData;
		if(cbAsynsEndData.callback == null) return;
		if(cbAsynsEndData.count == 0){
			cbAsynsEndData.callback();
		}
		
		break;
	}
}

function output(msg){
	console.log(msg);
	jQuery('#res').append(msg + '<br>');
}