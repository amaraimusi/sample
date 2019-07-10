$(() => {
	
	console.log(typeof Neko); // → function
	console.log(typeof Inu); // → undefined
	
	var neko = new Neko();
	neko.bark();
});


class Neko{
	bark(){
		console.log('ナゴー');
	}
}