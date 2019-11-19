
$(()=>{

		var app; // vue.js
		jQuery(() => {
			app = new Vue({
					el: '#app1',
					data: {
						bark: (msg)=>{
							console.log(msg);
							alert(msg);
						}
	
					}
				})
		});	
	
});