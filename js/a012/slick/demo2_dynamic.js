

$(()=>{
	$('#test1').slick({ 
		arrows: true, // 左右のボタンを表示
		dots: true, // 下部分にドットを表示
		accessibility: true,
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3
	});
	
	
});

function addItem(){
	$('#test1').append("<div>追加アイテム</div>");
	$('#test1')[0].slick.refresh();
}