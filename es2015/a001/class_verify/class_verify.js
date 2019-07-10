/**
 * ES2015(ES6)のクラスを検証
 */

$(function(){
	
	var animal = new Animal('ネオンテトラ');
	animal.test_func();
});

class Animal{
	
	constructor(animal_name){
		this.name = animal_name;
	}
	
	
	test_func(){
		let name = this._test2();
		console.log(`hello_world=${name}`);//■■■□□□■■■□□□■■■□□□)
		$('#res').html(name);
	}
	
	_test2(){
		return this.name;
	}
}