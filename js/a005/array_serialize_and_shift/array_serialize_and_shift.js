/**
 * 
 */


	$(function(){
		
		var ary = [1,2,3,3,3,4,8,8,9];
		$('#res1').html(JSON.stringify(ary));
		
		ary = _serializeAndShift(ary);
		
		$('#res2').html(JSON.stringify(ary));
		
	});
	
	/**
	 * 配列の重複を連番化しつつ昇順になるようシフトする
	 * 
	 * @note
	 * あらかじめ配列は昇順でソートしておくこと。
	 * また値は数値型にすること。（文字列型だとバグになる）
	 * 
	 * @param ary 配列
	 * @returns 配列
	 */
	function _serializeAndShift(ary){
		
		var last_index = ary.length - 1;
		var loop_out = true; // ループアウトフラグ 	true:ループ抜け , false:ループ継続
		var shift_diff; // シフト比較値
		
		for(var n=0 ; n < 1000000 ; n++){
			
			shift_diff = null; // シフト比較値をリセット
			loop_out = true;
			
			for(var i = last_index ; i >= 0 ; i--){
				
				// 配列の値とシフト比較値が一致する場合
				if(ary[i] === shift_diff){
					ary[i+1] ++;
					loop_out = false;
					break;
				}else{
					shift_diff = ary[i];
				}

			}

			if(loop_out == true){
				break;
				
			}
			
		}
		
		return ary;
	}