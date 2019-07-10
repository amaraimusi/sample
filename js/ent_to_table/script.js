
$(document).ready(function(){

	var keys=['id','name','value1','value2'];

	var ary=[
	          [1,'neko',101,1001],
	          [2,'nezumi',202,2002],
	          [3,'usi',303,3003],
	          [4,'tora',404,4004],
	          [5,'u',505,5005],
	          ];

	//2次元配列とキー配列から連想配列オブジェクト（エンティティリスト）を作成する。
	var hash=createHashFromAry(keys,ary);

	//★連想配列オブジェクトからテーブルHTMLを生成する。
	var html=createTbl_hash(hash);

	$("#tbl_div").html(html);


});


/**
 * 2次元配列とキー配列から連想配列オブジェクト（エンティティリスト）を作成する。
 * @param keys キー配列
 * @param ary  2次元配列
 * @returns 連想配列オブジェクト
 */
function createHashFromAry(keys,ary){
	var obj={};
	var x_cnt=ary[0].length;
	for(var y=0;y<ary.length;y++){
		var ent={};
		for(var x=0;x<x_cnt;x++){

			ent[keys[x]]=ary[y][x];
		}
		obj[y]=ent;
	}

	return obj;
}


/**
 * 連想配列オブジェクトからテーブルHTMLを生成する。
 * キーをヘッダーの名前に利用する。
 * @param hash 連想配列オブジェクト
 * @return テーブルHTML
 */
function createTbl_hash(hash){

	//1行目のエンティティからヘッダー部分を組み立て
	var html="<table border='1'><thead><tr>"
	for(var k in hash[0]){
		html+="<th>" + k + "</th>";
	}
	html+="</th></thead>\n";
	html+="<tbody>\n";



	//連想配列をループ。
	for(var i in hash){
		html+="<tr>";
		var ent=hash[i];
		for(var k in ent){
			var v=ent[k];
			html+="<td>" + v + "</td>";
		}
		html+="</tr>\n";
	}

	html+="</tbody></table>\n";

	return html;
}


