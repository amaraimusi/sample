
jQuery(()=>{
	
	var obj1 = {'cat':100,'dog':200};
	output(obj1,'#res1');
	
	var obj2 = {'dog':1000,'kani':300};
	output(obj2,'#res2');
	
	var obj3 = Object.assign({}, obj1, obj2);
	output(obj3,'#res3');
	
});

function output(obj,slt){
	console.log(obj);
	var json = JSON.stringify(obj);
	jQuery(slt).html(json);
	
}