
class Cat extends Animal{
	
	constructor(){
		$('#res').append('茶ひげ猫と');
		super();
		
		this.item = 'スリッパ';
	}
	
	meows(){
		super.bark('大きな茶ひげ'); // スーパークラスのメソッドを呼び出す
	}
	
	// メソッドのオーバーライド
	runAway(color_text){
		
		super.runAway(color_text);
		
		 let text = `${color_text}子猫も一緒に逃げ出した。<br>`;
        $('#res').append(text);

	}
}