
var app;
jQuery(()=>{
	
	let styles123 = {
			color:'#585858',
	}
	
	app = new Vue({
		el: '#app1',
		data: {
			styles123: styles123,
		},
		methods: {
			changeStyle: () => {
						this.app.styles123.color = '#dc4f43';
						this.app.styles123['padding'] = '20px';
						this.app.styles123['border'] = 'solid 4px #f19355';
				}
			}
	});
});