/**
 * 並べ替えと値の取得 | jquery-ui-sortable
 * 
 * @date 2016-1-20 新規作成
 */


$( function() {
	$( "#xxx" ).sortable();
	$( "#xxx" ).disableSelection();
});


function getList(){
	
	var res='';
	
	$('#xxx li').each(function(){
		var item = $(this).html();
		console.log(item);
		res += item + '<br>';
	});
	
	
	$('#res').html(res);
	
}