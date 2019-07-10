
var foldingTa;
$(()=>{
	foldingTa = new FoldingTa();
	foldingTa.init({
		'form_slt':'#form1',
	});
});

// 「外部による値変更」ボタンを押下
function test_input_by_outsider(){
	jQuery('.test1').val(`我が子よ，
		その時にはこのように行動して自分を救い出せ。あなたは仲間の者の掌中に陥ったからである。すなわち，行って，自分を低くし，その仲間の者にあらしのように懇願を浴びせよ。`);
	jQuery('.test2').val(`さて，カナン人でアラドの王である者がネゲブに住んでいたが，その者は，イスラエルがアタリムを通ってやって来たことを聞いた。
		それで彼はイスラエルに対して戦いを始め，その幾人かをとりこにして連れ去った。`);
}

// 「一括反映表示」ボタン押下
function reflection(){
	foldingTa.reflection();
}