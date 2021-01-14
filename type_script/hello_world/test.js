var HelloWorld = /** @class */ (function () {
    /** コンストラクタ
     */
    function HelloWorld(str1) {
        this.m_big_buta = '大きなブタ2'; // メンバ
        console.log(str1); //■■■□□□■■■□□□
    }
    // publicメソッド
    HelloWorld.prototype.bark = function () {
        var value1 = 333; // 数値型の宣言
        var str1 = 'こんにちは世界！'; // 文字列型の宣言
        console.log(value1);
        console.log(str1);
        var obj1 = { neko: '猫', 'inu': '犬' }; // 普通の連想配列
        this._working(); // privateメソッドの呼び出し
        console.log(this.m_big_buta); // メンバを呼び出してみる
    };
    // privateメソッド
    HelloWorld.prototype._working = function () {
        console.log('プライベートで猫が歩く'); //■■■□□□■■■□□□
    };
    return HelloWorld;
}());
var helloWorld = new HelloWorld("Hello World!");
helloWorld.bark();
