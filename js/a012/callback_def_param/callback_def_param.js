

$(()=>{
	let ahiru = new Ahiru();
	let torikago = new Torikago();
	
	var func1 = ahiru.bark.bind(ahiru); // ← コールバックにする関数にAhiruのオブジェクトを引数として渡す
	torikago.setCallback(func1);
	
	// テスト実行
	torikago.move();
	
});


class Ahiru{
	bark(){
		this.barkDetail(); // thisはbindで渡されたAhiruオブジェクトを指している。
	}
	
	barkDetail(){
		$('#res').html("ガーガー");
	}
}

class Torikago{
	
	setCallback(callback){
		this.callback = callback;
	}
	
	move(){
		this.callback();
	}
}