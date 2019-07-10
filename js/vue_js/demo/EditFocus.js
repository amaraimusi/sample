/**
 * 編集フォーカス
 * 
 * @date 2017-12-12
 * @version 1.0.0
 * 
 * @note
 * 指定要素をクリックしてフォーカスすると編集できるようにする。
 * 
 * HTMLの記述例
 * 
 * 	<label class="edit_focus" for="hoge" >テスト</label>
 * 	<input class="edit_focus" type="text" name="hoge">
 * 
 * 	<label class="edit_focus" for="neko" >ネコ</label>
 * 	<input class="edit_focus" type="text" name="neko">
 * 
 * @param class_name 項目要素のclass属性名。省略時は"edit_focus"になる。
 * 
 */
function editFocusOn(class_name){
	if(!class_name){
		class_name = "edit_focus";
		
	}
	
	var elms = document.getElementsByClassName(class_name);
	
	var data={}; // 項目要素データ
	
	// 項目データに入力要素やラベル要素をセットする。
	for(var i in elms){
		if(isNaN(i)) continue;
		var elm = elms[i];

		if(elm.tagName == 'INPUT'){
			var name = elm.getAttribute('name');
			if(!data[name]){
				data[name] = {};
			}
			var ent = data[name];
			elm.style.display="none"; // 入力要素は隠す
			ent['input'] = elm;
			
		}else{
			var name = elm.getAttribute('for');
			if(!data[name]){
				data[name] = {};
			}
			var ent = data[name];
			ent['label'] = elm;
		}
		
	}
	
	// 各項目要素にイベントを追加
	for(var name in data){
		var ent = data[name];
		
		// ラベル要素をクリックしたら入力要素を表示するイベント
		var label = ent['label'];
		label.addEventListener('click',function(e){
			e.stopPropagation(); // 入力要素の外側クリックイベントを止める（windowクリックイベントを止める）
			var name = this.getAttribute('for');
			var input = data[name]['input'];
			input.style.display="inline-block";
			this.style.display="none";
			data[name]['input_flg'] = 1;
		});
		
		// 入力要素をクリックしてフォーカスする際、外側クリックイベントを発動させない。
		var input = ent['input'];
		input.addEventListener('click',function(e){
			e.stopPropagation(); // 入力要素の外側クリックイベントを止める（windowクリックイベントを止める）
		});
		
	}
	
	// 外側クリックイベント | 外側クリックでラベル表示状態に戻す
	window.addEventListener('click',function(){
		for(var name in data){
			var ent = data[name];
			if(ent['input_flg']){
				ent['input_flg'] = 0;
				ent['input'].style.display="none";
				ent['label'].style.display="inline-block";
			}
		}
	});
	
}

