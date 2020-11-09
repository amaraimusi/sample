

let list1 = ['赤猫', 'キジシロ' ,'サバトラ', 'うなぎ猫', '横暴な猫', '捨てられてない猫'];


$(()=>{
	print(list1);
});
function test(){
	
	let index = jQuery('#index').val();
	list1.splice (index, 1); // 配列から指定要素を削除する。（文字列を指定すると末尾を、空や負値を指定すると先頭が削除される）
	print(list1);
	
}

function print(list1){
	
	let html = '';
	for(let i in list1){
		let value = list1[i];
		html += `<tr><td>${i}</td><td>${value}</td></tr>`;
	}
	
	let tbl = jQuery('.tbl2 tbody');
	tbl.html(html);
}