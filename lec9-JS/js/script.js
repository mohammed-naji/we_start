// let age = 22;
// if(age >= 20) {
//     console.log('Welcome');
// }else {
//     console.log('Error');
// }

// Condtion ? True : False
// let res = (age >= 20) ? 'Welcome' : 'Error';
// console.log( res );

// min , max
// Math.random() * (max - min)) + min)
// console.log(Math.floor((Math.random() * 5) + 5) + 1);

// console.log(Math.round(1.4999999999));

// let num = 5.645785522;
// console.log(num.toFixed(2));

// let skills = 'HTML,CSS,JS,PHP';
// skills = skills.split(',')
// let ages = [50, 60, 11, 20];

// console.log(skills);
// skills = skills.join(',');
// console.log(skills);

// let x = [5, 6, 9, 77, 3, 5];

// let newX = x.reduce(function(el, sum) {
//     return el + sum;
// }) 

// console.log(newX);

// let newX = x.filter(function(el) {
//     return el > 5;
// });

// x.forEach(function(el) {
//     console.log(el);
// });

// let newX = x.map(function(el) {
//     return el * this;
// }, 2);

// console.log(newX);

// setTimeout(function() {
//     console.log('Timeout');
// }, 2000);

// setInterval(function() {
//     console.log('Interval');
// }, 2000);

// x.map()
// Map
// Filter
// forEach

// let names = ['Ali', 'Ahmed', 'Manal', 'Lamees', 'Sawsan'];

// al

// shoWelcome('Ali', 'Mohammed');

// function shoWelcome(name2, ...name) {
//     console.log(name);
// }

// let products = [
//     {

//     }
// ]

// let person = {
//     name: 'Mohammed',
//     age: 28
// };

// console.log(person.name);

// let prods = [
//     {
//         name: "fff",
//         price: 55, 
//         features: 'fff,ff,eee,fff'
//     },
//     {
//         name: "fff",
//         price: 55, 
//         features: 'fff,ff,eee,fff'
//     },
//     {
//         name: "fff",
//         price: 55, 
//         features: 'fff,ff,eee,fff'
//     }
// ]

// console.log(document.body); 
// console.log(window.innerHeight);

// console.log(document.getElementsByTagName('p')[0]);
// document.getElementById("one").style.cssText = `
//   color: red; 
//   font-size: 50px;
// `;
// document.getElementById('one').innerText = 'New Code From <span>JS</span>'
// document.getElementById('one').innerText = 'New Code From JS'
// console.log(document.getElementById('one'));

// console.log(document.getElementById('btn'));
document.getElementById('btn').addEventListener('click', function() {
    document.getElementById('result').innerHTML = 'Done';
})