let paginationRain
$(() =>{

	paginationRain = new PaginationRain('tbl1',{
		cur_page_num:0, 
		search_cols_str:'1,2,3',
		last_page_flg:0,
		search_box_w_xid:'search1',
		});

});


function remakeHtmlTbl(){
	
	let trs_html = '';
	
	for(let i=0;i<40;i++){
		trs_html += `
			<tr>
				<td>${i}</td>
				<td>テスト</td>
				<td>種別${i}</td>
				<td>テストネーム${i}</td>
				<td>Sample</td>
				<td>XXX</td>
			</tr>
			`;

	}
	
	$('#tbl1 tbody').html(trs_html);
	
	paginationRain.refresh();
	
}