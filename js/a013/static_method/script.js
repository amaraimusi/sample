


$(()=>{
	Neko.bark('帽子猫');
});

class Neko{
	
	static bark(neko_name){
		$('#res').append(`${neko_name}はミーとなく<br>`);
	}
	
}

$(()=>{
	let dog = new Dog();
	dog.barkWrap();
});

class Dog{
	barkWrap(){
		Dog.bark('赤犬');
	}
	
	static bark(dog_name){
		$('#res').append(`${dog_name}はポウポウとなく<br>`);
	}
	
}

$(()=>{
	Pig.barkWrap();
});

class Pig{
	static barkWrap(){
		this.bark('黒豚');
	}
	
	static bark(name){
		$('#res').append(`${name}はキーキーとなく<br>`);
	}
	
}


