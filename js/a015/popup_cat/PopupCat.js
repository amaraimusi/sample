

class PopupCat{
	
	popupize(xid, param){
		this.popupElm = jQuery('#' + xid);
		if(param == null) param = {};
		if(param.popup_type==null) param.popup_type='right_bottom';
		if(param.z_index==null) param.z_index='2';
		if(param.fadein_time==null) param.fadein_time=1000;
		if(param.set_timeout_time==null) param.set_timeout_time=1500;

		let css_left = '0px';
		let css_top = '0px';
		let css_right = '0px';
		let css_bottom = '0px';
		
		switch(param.popup_type){
			case 'left_top':
				css_right = 'auto';
				css_bottom = 'auto';
				break;
			case 'right_top':
				css_left = 'auto';
				css_bottom = 'auto';
				break;
			case 'left_bottom':
				css_right = 'auto';
				css_top = 'auto';
				break;
			case 'right_bottom':
				css_left = 'auto';
				css_top = 'auto';
				break;
			default:
				throw Error('PopupCat Error PCAT220129A')
			
		}
		this.popupElm.css({
			display: 'none',
			position: 'fixed',
			'left': css_left,
			'top': css_top,
			'right': css_right,
			'bottom': css_bottom,
			'z-index': param.z_index,
		});
		
		
		this.param = param;
		
		
	}
	
	getPopupElm(){
		return this.popupElm;
	}
	
	pop(callback){
		
		this.afterCallback = callback;
		
		
		this.popupElm.hide();
		this.popupElm.fadeIn(this.param.fadein_time, ()=>{
			window.setTimeout(()=>{
				console.log('xxx');//
				this.popupElm.hide();
				if(this.afterCallback) this.afterCallback();
			}, this.param.set_timeout_time);
		});
	}
	
}
