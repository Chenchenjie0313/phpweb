/**

1.let  不存在变量提升
var命令声明的，在全局范围内都有效，所以全局只有一个变量i
使用let，声明的变量仅在块级作用域内有效
var a = [];
for (var i = 0; i < 10; i++) {
  a[i] = function () {
    console.log(i);  <=全局
  };
}
a[6](); // 10

var a = [];
for (let i = 0; i < 10; i++) {
  a[i] = function () {
    console.log(i);  <=块级作用域内
  };
}
a[6](); // 6


ES6明确规定，如果区块中存在let和const命令，
这个区块对这些命令声明的变量，从一开始就形成了封闭作用域。
凡是在声明之前就使用这些变量，就会报错。

存在全局变量tmp，但是块级作用域内let又声明了一个局部变量tmp，
导致后者绑定这个块级作用域，所以在let声明变量前，对tmp赋值会报错
var tmp = 123;

if (true) {
  tmp = 'abc'; // ReferenceError
  let tmp;
}

function bar(x = y, y = 2) {
  return [x, y];
}

bar(); // 报错
参数x默认值等于另一个参数y，而此时y还没有声明，属于”死区“

// 不报错
var x = x;

不允许重复声明 

// 报错
let x = x;

// 报错
function func() {
  let a = 10;
  let a = 1;
}


function f1() {
  let n = 5;
  if (true) {
    let n = 10;
  }
  console.log(n); // 5
}

const声明一个只读的常量。一旦声明，常量的值就不能改变。
const实际上保证的，并不是变量的值不得改动，而是变量指向的那个内存地址不得改动。

const foo = {};
// 为 foo 添加一个属性，可以成功
foo.prop = 123;
foo.prop // 123
// 将 foo 指向另一个对象，就会报错
foo = {}; // TypeError: "foo" is read-only

const a = [];
a.push('Hello'); // 可执行
a.length = 0;    // 可执行
a = ['Dave'];    // 报错

如果真的想将对象冻结，应该使用Object.freeze方法
const foo = Object.freeze({});
// 常规模式时，下面一行不起作用；
// 严格模式时，该行会报错
foo.prop = 123;

除了将对象本身冻结，对象的属性也应该冻结。下面是一个将对象彻底冻结的函数。
var constantize = (obj) => {
  Object.freeze(obj);
  Object.keys(obj).forEach( (key, i) => {
    if ( typeof obj[key] === 'object' ) {
      constantize( obj[key] );
    }
  });
};


ES5 只有两种声明变量的方法：var命令和function命令。
ES6 除了添加let和const命令，后面章节还会提到，
另外两种声明变量的方法：import命令和class命令。
所以，ES6 一共有6种声明变量的方法。

顶层对象，在浏览器环境指的是window对象
ES5 之中，顶层对象的属性与全局变量是等价的。

let命令、const命令、class命令声明的全局变量，不属于顶层对象的属性。

ES6 允许按照一定模式，从数组和对象中提取值，对变量进行赋值，这被称为解构
let a = 1;
let b = 2;   let [a, b, c] = [1, 2, 3];
let c = 3;

ES6 提供了新的数据结构 Set。它类似于数组，但是成员的值都是唯一的，没有重复的值
const s = new Set();
[2, 3, 5, 4, 5, 2, 2].forEach(x => s.add(x));
for (let i of s) {
  console.log(i);
}
// 2 3 5 4


 * */