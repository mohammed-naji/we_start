let products = [
    {
        name: "Product 1",
        price: 100,
        features: "Feature 1, Feature 2, Feature 2"
    },
    {
        name: "Product 2",
        price: 50,
        features: "Feature 1, Feature 2, Feature 2"
    },
    {
        name: "Product 3",
        price: 30,
        features: "Feature 1, Feature 2, Feature 2"
    },
    {
        name: "Product 4",
        price: 70,
        features: "Feature 1, Feature 2, Feffff"
    }
]

let wrapper = document.querySelector('.wrapper');
// for(let i = 0; i < products.length ; i++) {
//     let box = document.createElement('div');
//     box.setAttribute('class', 'box');

//     let h3 = document.createElement('h3');
//     h3.innerHTML = products[i].name
//     box.appendChild(h3)

//     let p = document.createElement('p');
//     if(products[i].price < 50) {
//         p.innerHTML = 'Sale ' + products[i].price + '$'
//     }else {
//         p.innerHTML = products[i].price + '$'
//     }
//     box.appendChild(p)

//     let f = products[i].features.split(', ');
//     for(let j = 0 ; j < f.length ; j++) {
//         let span = document.createElement('span');
//         span.innerHTML = f[j]
//         box.appendChild(span)
//     }

//     wrapper.appendChild(box)
// }

// products.forEach(el => {
//     let f = el.features.split(', ').map(fe => `<span>${fe}</span>`).join('');
//     let box = `
//         <div class="box">
//             <h3>${el.name}</h3>
//             <p>${el.price}$</p>
//             ${f}
//         </div>
//     `
//     wrapper.innerHTML += box;
// });

// products.forEach(el => {
for({name, price, features} of products){
    let f = features.split(', ').map(fe => `<span>${fe}</span>`).join('');
    let box = `<div class="box">
            <h3>${name}</h3>
            <p>${price < 50 ? 'Sale '+ price : price}$</p>
            ${f}
        </div>`
    wrapper.innerHTML += box;
}

// let user = {
//     name: 'Ali',
//     age: 23
// }

// let {name, age} = user;

// console.log(name);

// let person = {
//     name: 'Ramez',
//     age: 27,
//     job: 'Developer'
// }

// person.forEach(el => {
//     console.log(el);
// })

// for(value of person) {
//     console.log(value);
// }

let darkbtn = document.querySelector('#dark')
let body = document.querySelector('body')
darkbtn.onclick = () => {
    // if(body.classList.contains('dark')) {
    //     body.classList.remove('dark');
    // }else {
    //     body.classList.add('dark');
    // }
    body.classList.toggle('dark')
    darkbtn.querySelector('i').classList.toggle('fa-moon')
    darkbtn.querySelector('i').classList.toggle('fa-sun')
    // darkbtn.classList.toggle('fa-sun');
}