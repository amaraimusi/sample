
/*
* jsQR.jsのラッパークラス
* @note QRコードをシンプルに利用するためのクラス。
* @auther amaraimusi
* @version 1.0.0
* @since 2022-1-15
* 
*/
class JsQrEx{

	/*
	* コンストラクタ
	* @param string canvas_xid canvasタグ要素のid属性値
	* @param function readCallback QRコードの読込成功時に呼び出されるコールバック
	* @param object param 下記のプロパティは省略可能
	* 	- cvs_width int キャンバスの横幅
	* 	- cvs_height int キャンバスの縦幅
	* 	- camera_width int カメラの解像度　横
	* 	- camera_height int カメラの解像度　縦
	* 	- intarval int setTimerの再帰呼出間隔
	* 	- errCallback function エラーコールバック←カメラ不許可時に呼び出される。
	*/
	constructor(canvas_xid,readCallback, param){

		this.active = false;
		if(canvas_xid==null) new Error('Sytem error:canvas_xid is empty!');
		if(param==null) param = {};
		this.readCallback = readCallback;
		if(typeof readCallback != 'function') throw new Error('System err:readCallback is not function');
		
		if(param['cvs_width'] == null) param['cvs_width'] = 640;
		if(param['cvs_height'] == null) param['cvs_height'] = 480;
		if(param['camera_width'] == null) param['camera_width'] = 640;
		if(param['camera_height'] == null) param['camera_height'] = 480;
		if(param['intarval'] == null) param['intarval'] = 50; // ms
		this.param = param;

		// エラーコールバック
		this.errCallback = null;
		if(typeof param['errCallback'] == 'function'){
			this.errCallback = param.errCallback;
		}
		
		let video=document.createElement('video');
		video.setAttribute("autoplay","");
		video.setAttribute("muted","");
		video.setAttribute("playsinline","");
		video.onloadedmetadata = function(e){video.play();};
		let cvs=document.getElementById(canvas_xid);
		let cvs_ctx=cvs.getContext("2d");
		let tmp = document.createElement('canvas');
		let tmp_ctx = tmp.getContext("2d");
		
		this.video = video;
		this.cvs = cvs;
		this.cvs_ctx = cvs_ctx;
		this.tmp = tmp;
		this.tmp_ctx = tmp_ctx;

		//選択された幅高さ
		let w = video.videoWidth;
		let h = video.videoHeight;
		//画面上の表示サイズ
		cvs.style.width=(w/2)+"px";
		cvs.style.height=(h/2)+"px";
		
		//内部のサイズ
		cvs.setAttribute("width",w);
		cvs.setAttribute("height",h);


		//カメラ使用の許可ダイアログが表示される
		navigator.mediaDevices.getUserMedia(
			//マイクはオフ,なるべく背面カメラを使用、映像サイズはなるべく640×480にする。
			{"audio":false,"video":{"facingMode":"environment","width":{"ideal":this.param.camera_width},"height":{"ideal":this.param.camera_height}}}
		).then( //許可された場合
			(stream)=>{
				video.srcObject = stream;
				//this.start();
			}
		).catch( //許可されなかった場合
			(err)=>{
				if(this.errCallback == null){
					alert('カメラが不許可になっているのでQRコード読込カメラを起動できません。カメラを許可してください。');
				}else{
					this.errCallback(err);
				}
			}
			
		);
	}
	
	_scan(){

		let video = this.video;
		let cvs = this.cvs;
		let cvs_ctx = this.cvs_ctx;
		let tmp = this.tmp;
		let tmp_ctx = this.tmp_ctx;
		
		//選択された幅高さ
		let w = video.videoWidth;
		let h = video.videoHeight;

		//画面上の表示サイズ
		cvs.style.width = this.param.cvs_width + "px";
		cvs.style.height= this.param.cvs_height + "px";
		
		//内部のサイズ
		cvs.setAttribute("width",w);
		cvs.setAttribute("height",h);
		
		// 赤枠を描画する
		let m = 0;
		if(w>h){m=h*0.5;}else{m=w*0.5;}
		let x1=(w-m)/2;
		let y1=(h-m)/2;
		cvs_ctx.drawImage(video,0,0,w,h);
		cvs_ctx.beginPath();
		cvs_ctx.strokeStyle="rgb(255,0,0)";
		cvs_ctx.lineWidth=2;
		cvs_ctx.rect(x1,y1,m,m);
		cvs_ctx.stroke();
		
		
		tmp.setAttribute("width",m);
		tmp.setAttribute("height",m);
		tmp_ctx.drawImage(cvs,x1,y1,m,m,0,0,m,m);
		let imageData = tmp_ctx.getImageData(0,0,m,m);
		let scanResult = jsQR(imageData.data,m,m);
		if(scanResult){
			
			// 読込後コールバック
			this.readCallback(scanResult.data);
		}
		if(this.active == true){
			setTimeout(()=>{this._scan();},this.param.intarval);
		}
	}
	
	
	start(){
		if(this.active == false){
			this.active = true;
			setTimeout(()=>{this._scan();},500);//0.5秒後にスキャン開始
		}
	}
	
	stop(){
		this.active = false;
	}
}