/**
 * 
 */


function test1(){
	
	Promise.resolve()
	.then(function(){
		return new Promise(function(fulfilled, rejected){
			window.setTimeout(function(){
				$('#res1').append('コールバック1<br>');
				fulfilled();
			},1000);
		})
	})
	.then(function(){
		return new Promise(function(fulfilled, rejected){
			window.setTimeout(function(){
				$('#res1').append('コールバック2<br>');
				fulfilled();
			},1000);
		})
	})
	.then(function(){
		return new Promise(function(fulfilled, rejected){
			window.setTimeout(function(){
				$('#res1').append('コールバック3<br>');
				fulfilled();
			},1000);
		})
	});
	
}


function test2(){
	var promiseTest = new PromiseTest();
	promiseTest.func1();
}

class PromiseTest{
	
	constructor(){
		this.test_a = 999;
	}
	
	func1(){
		Promise.resolve()
		.then(() => {
			return new Promise((fulfilled, rejected) => {
				window.setTimeout(() => {
					$('#res2').append(this.test_a + ' コールバック1<br>');
					this.test_a ++;
					fulfilled();
				},1000);
			})
		})
		.then(() => {
			return new Promise((fulfilled, rejected) => {
				window.setTimeout(() => {
					$('#res2').append(this.test_a + ' コールバック2<br>');
					this.test_a ++;
					fulfilled();
				},1000);
			})
		})
		.then(() => {
			return new Promise((fulfilled, rejected) => {
				window.setTimeout(() => {
					$('#res2').append(this.test_a + ' コールバック3<br>');
					this.test_a ++;
					fulfilled();
				},1000);
			})
		})
		;
		
	}
}







function test3(){
	
	Promise.resolve()
	.then(function(){
		return new Promise(function(fulfilled, rejected){
			window.setTimeout(function(){
				$('#res3').append('コールバック1X<br>');
				fulfilled();
			},1000);
		})
	})
	.then(function(){
		return new Promise(function(fulfilled, rejected){
			window.setTimeout(function(){
				$('#res3').append('コールバック2<br>');

				rejected('リジェクト:エラーキャッチのテストです。');

			},1000);
		})
	})
	.then(function(){
		return new Promise(function(fulfilled, rejected){
			window.setTimeout(function(){
				$('#res3').append('コールバック3<br>');
				fulfilled();
			},1000);
		})
	}).catch(function(e) {
		console.log(e);
		alert(e);
		
    })
	;
}











