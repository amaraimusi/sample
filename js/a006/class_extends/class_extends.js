
$(()=>{
	var neko = new Neko();
	neko.test1();
	neko.test2();
});

class Animal{
	
	constructor(){
		$("#res1").append('Animalクラスのconstructorが呼び出されました。<br>');
	}
	
	test1(){
		$("#res1").append('Animalクラスのtest1メソッドが呼び出されました。<br>');
	}
}

class Neko extends Animal{
	
	constructor(){
		super();
		$("#res1").append('Nekoクラスのconstructorが呼び出されました。<br>');
	}
	
	test2(){
		$("#res1").append('Nekoクラスのtest2メソッドが呼び出されました。<br>');
		this.test1();
	}
}