// Ajax Using XMLHttpRequest
// var xhr = new XMLHttpRequest();
// xhr.onreadystatechange = function() {
//     if(this.readyState == 4 && this.status == 200) {
//         console.log('Ajax');
//         JSON.parse(this.responseText).forEach(el => {
//             let item = `
//                 <h2>${el.title}</h2>
//                 <p>${el.body}</p>
//                 <hr>
//                 `
//             document.querySelector('.wrapper').innerHTML += item
//         });
        
//     }
// }
// xhr.open("GET", "https://jsonplaceholder.typicode.com/posts", true);
// xhr.send();

// console.log('done');

// Ajax By Fetch API
// let res = fetch("https://jsonplaceholder.typicode.com/postssss")
// .then(res => res.json())
// .then(res => console.log(res))
// .catch(err => console.log(err));

// async function getRes() {
//     let res = await fetch("https://jsonplaceholder.typicode.com/posts")
//     return res;
// }

// console.log(getRes().then(res));

// Ajax By Axios ** recommended
const axios = require('axios')
axios.get("https://jsonplaceholder.typicode.com/posts")
.then(res => {
    res.data.forEach(el => {
        let item = `
            <h2>${el.title}</h2>
            <p>${el.body}</p>
            <hr>
            `
        document.querySelector('.wrapper').innerHTML += item
    });
})
// console.log(res);

// Ajax By Jquery
// $.get({
//     url: "https://jsonplaceholder.typicode.com/posts",
//     success: res => {
//         res.forEach(el => {
//             let item = `
//                 <h2>${el.title}</h2>
//                 <p>${el.body}</p>
//                 <hr>
//                 `
//             document.querySelector('.wrapper').innerHTML += item
//         });
//     },
//     error: err => {
//         console.log(err);
//     }
// });