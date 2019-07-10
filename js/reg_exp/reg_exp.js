/**
 * 正規表現のテスト
 * @date 2016-4-4 新規作成
 */

$( function() {
	

	var data = [
			{'reg_exp':'あ','note':'「あ」が文字列中に含まれているか'},
			{'reg_exp':'い','note':'「い」が文字列中に含まれているか'},
			{'reg_exp':'12','note':'「12」が文字列中に含まれているか'},
			{'reg_exp':'^あ','note':'先頭は「あ」であるか'},
			{'reg_exp':'^い','note':'先頭は「い」であるか'},
			{'reg_exp':'3$','note':'末尾は「3」であるか'},
			{'reg_exp':'2$','note':'末尾は「2」であるか'},
			{'reg_exp':'\\d{1}$','note':'末尾は数値か（1連続)'},
			{'reg_exp':'\\d{2}$','note':'末尾は2連続の数値か'},
			{'reg_exp':'\\d{3}$','note':'末尾は3連続の数値か'},
			{'reg_exp':'\\d{4}$','note':'末尾は4連続の数値か'},
			{'reg_exp':'\\d{1,2}$','note':'末尾の1-2番目に数値が含まれているか'},
			{'reg_exp':'\\d{1,3}$','note':'末尾の1-3番目に数値が含まれているか'},
			{'reg_exp':'\\d{1,4}$','note':'末尾の1-4番目に数値が含まれているか'},
			{'reg_exp':'^\\d{1,4}','note':'先頭の1-4番目に数値が含まれているか'},
			{'reg_exp':'a{2}','note':'「aa」が含まれているか'},
			{'reg_exp':'a{3}','note':'「aaa」が含まれているか'},
			{'reg_exp':'\\w','note':'「A-Za-z0-9_」が含まれているか'},
			{'reg_exp':'^\\d+$','note':'すべて数値か'},
			{'reg_exp':'^\\w+$','note':'すべて半角英数字か'},
			{'reg_exp':'^[ぁ-んァ-ン]+\\w+$','note':'前半はかな（カタカナも含む）で後半は半角英数字であるか'},
			{'reg_exp':'いう','note':'「いう」が文字列中に含まれているか'},
			{'reg_exp':'ねこ','note':'「ねこ」が文字列中に含まれているか'},
			{'reg_exp':'い|え','note':'「い」または「え」が文字列中に含まれているか'},
			{'reg_exp':'犬|え','note':'「犬」または「え」が文字列中に含まれているか'},
			{'reg_exp':'犬|豚','note':'「犬」または「え」が文字列中に含まれているか'},
			{'reg_exp':'\/','note':'「/」が文字列中に含まれているか'},
			{'reg_exp':'\\\\','note':'「\\」が文字列中に含まれているか ※'},
			{'reg_exp':';|<|>|%|$|.\/|\\\\','note':'ファイル名のチェック用'},
			
	];
	
		

	var tbl = $('#res_tbl tbody');
	var sample_str = "あいうえおx/y\\z9aabbc123";
	for(var i in data){
		var ent = data[i];
		var reg_exp = ent['reg_exp'];
		var note = ent['note'];
		var flg = "×";
		
		var res = sample_str.match(reg_exp);
		var str1 = '';
		var offset = '';
		if(res){
			flg = "○";
			var str1 = res[0];
			var offset = res['index'];
		}
		
		var reg_exp2 = reg_exp.replace('\\','\\\\');
		var sc = "var res = \"" + sample_str + "\".match('" + reg_exp2 + "');";
		
		var h = "<tr><td>" + reg_exp2 + 
			"</td><td>" + flg + 
			"</td><td>" + str1 +
			"</td><td>" + offset +
			"</td><td>" + sc +
			"</td><td>" + note +
			"</td></tr>";
		tbl.append(h);
	}
	

});


