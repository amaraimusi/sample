
/**
 * モーダル化ライブラリ
 * @since 2022-1-21
 * @version 1.0.0
 * @auther amaraimusi
 * @license MIT
 */
class ModalCat{
	
	modalize(xid){
		
		let main_xid = xid + '_js_main'; // xidで指定した要素のラップ要素（指定要素の親要素）
		let close_xid = xid + '_js_modal_close';// id属性名：背景クリックによる閉じる

		let content = jQuery('#' + xid);
		content.wrap(`<div id='${main_xid}'></div>`); // モーダル化制御のためmain要素でラッピング
		let main = jQuery('#' + main_xid);
		
		let bg_close_html = `<div id='${close_xid}'></div>`;
		main.prepend(bg_close_html);
		
		let bgClose = jQuery(main.find('#' + close_xid)); // 背景クリック閉じる用要素
		
		main.css({
			display: 'none',
			height: '100vh',
			position: 'fixed',
			top: '0',
			left: '0',
			width: '100vw',
		});
		
		bgClose.css({
			background: 'rgba(0,0,0,0.8)',
			height: '100vh',
			position: 'absolute',
			width: '100vw',
		});
		
		content.css({
			background: '#fff',
			left: '50%',
			padding: '40px',
			position: 'absolute',
			top: '50%',
			transform: 'translate(-50%,-50%)',
			width: '60%',
		});

		this.main = main;

		bgClose.on('click',()=>{
			this.main.fadeOut();
			return false;
		});
		
	}
	
	open(){
		this.main.fadeIn();
	}
	
	close(){
		this.main.fadeOut();
	}
}