class Animal{
	
	constructor(){
		$('#res').append('黒猫<br>');
		
		this.master = '飼い主';
		this.item = 'チェンソー';
	}
	
	bark(name){
		let text = `${name}が吠える<br>`;
		$('#res').append(text);
	}
	
	runAway(color_text){
		let text = `${color_text}親猫は逃げ出した。<br>`;
		$('#res').append(text);
	}
	
	chase(){
		let text = `${this.master}は${this.item}を持って茶ひげ猫を追いまわした。<br>`;
		$('#res').append(text);
	}

	
}