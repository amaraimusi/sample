
var taskData ={};

function test1(){
	
	output('スタート');
	
	taskData = {
			'i':0,
			'num':5,
			'cb':()=>{output('すべて終了')}
		}
	
	for(var i=0;i<5;i++){
		var t = Math.random() * 1000;
		
		window.setTimeout(() => {
			output('コールバック');
			taskData.i ++;
			if(taskData.num <= taskData.i){
				taskData.cb();
			}
		},t);
	}
	
}

function output(msg){
	console.log(msg);
	jQuery('#res').append(msg + '<br>');
}