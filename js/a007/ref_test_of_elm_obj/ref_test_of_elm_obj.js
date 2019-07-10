var elmObj1;

$(()=>{
	elmObj = jQuery("#test1");
})

function addTest(){
	jQuery("#test1").append('<div>犬</div>');
}

function output(){
	jQuery("#res").html(elmObj.html());
}
