/**
 * 
 */

var m_obj;

// 初期化
$(() => {
	m_obj = $("#test1");
})

function test1(){
	$("#test1").html('キノボリトカゲ');
	alert(m_obj.html());// →キノボリトカゲ
}