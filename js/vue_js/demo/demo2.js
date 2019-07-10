




window.onload = function() {
	
	var animals = [
		{name:'国頭村'},
		{name:'今帰仁村'},
		{name:'読谷町'},
		{name:'那覇市'},
	];
	
	var app2 = new Vue({
			el: '#app-2',
			data: {
				neko:'ネコ',
				animals: animals,
			},
		});
	
	editFocusOn(); // 編集フォーカス<EditFocus.js>: 指定要素をクリックしてフォーカスすると編集できるようにする。	
}

