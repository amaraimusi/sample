
/**
 * サーバー上のファイルからarraybufferを取得する
 * @date 2016-5-20
 */


function test1(){
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'smp1.png', true);
	xhr.responseType = 'arraybuffer';
	xhr.onload = function(e) {
		
		var arrayBuffer = this.response;
		if (arrayBuffer) {
			var i8ary = new Uint8Array(arrayBuffer);
			console.log(i8ary);
		}
	};

	xhr.send();
}

