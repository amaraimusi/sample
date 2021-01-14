


class HelloWorld
{
    m_big_buta: string = '大きなブタ2'; // メンバ


    /** コンストラクタ
     */
    constructor(str1: string){
        console.log(str1);//■■■□□□■■■□□□
    }

    // publicメソッド
    public bark()
    {
        let value1: number = 333; // 数値型の宣言
        let str1: string = 'こんにちは世界！'; // 文字列型の宣言
        console.log(value1);
        console.log(str1);

        let obj1 = {neko:'猫','inu':'犬'}; // 普通の連想配列
        
        this._working(); // privateメソッドの呼び出し

        console.log(this.m_big_buta); // メンバを呼び出してみる
        
    }

    // privateメソッド
    private _working(){
        console.log('プライベートで猫が歩く');//■■■□□□■■■□□□
    }
}

var helloWorld = new HelloWorld("Hello World!");
helloWorld.bark();