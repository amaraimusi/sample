var app; // vue.js

$(()=>{
	
	app = new Vue({
			el: '#app1',
			data: {
				animal_id: 3,
			}
		})

	$('#animal_select').select2({
	    width: '300px',
	    language: 'ja', // 言語
	    tags: true
	  });

			
});

	