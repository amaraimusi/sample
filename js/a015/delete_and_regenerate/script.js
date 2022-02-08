
var jq_test1;

function regenerate(){
	
	console.log('要素の生成');
	
	let html = `<div id="test1" style="padding:20px;background-color:#d7eaf3">クリック</div>`;
	$('#example').html(html);
	
	jq_test1 = $('#test1');
	
	// 一つ目のイベントを追加
	jq_test1.click((evt)=>{
			var elm = $(evt.currentTarget);
			console.log('猫のエサ');
			alert('猫のエサを犬にあげてはいけないわけではない。');
		});
	
	// 二つ目のイベントを追加
	jq_test1.click((evt)=>{
			var elm = $(evt.currentTarget);
			console.log('ワンワン');
			alert('ワンワン');
		});
	
	
	
}


function deleteElm(){
	console.log('要素削除');
	if(jq_test1){
		jq_test1.remove();
	}
}