window.addEventListener("scroll",e=>{
    let header = document.querySelector("header")
    header.classList.toggle("sticky", window.scrollY > "721.6")
})

window.onscroll = function(){
    let btnTop = document.querySelector(".top")
    if(window.scrollY > 721.6){
        btnTop.style.bottom = "20px"

        // btnTop.style.opacity = "1"
        // btnTop.style.visibility = "visible"
    }else{
        btnTop.style.bottom = "-80px"

        // btnTop.style.opacity = "0"
        // btnTop.style.visibility = "hidden"
        
    }
}

let li = document.querySelectorAll(".shuffle li")
let imgs = document.querySelectorAll(".imag-box img")
let imgBox =document.querySelectorAll(".imgs-container .imag-box");
// console.log(imgs)
// console.log(imgBox)
li.forEach(li => {
    li.addEventListener("click",removeActive)
    li.addEventListener("click",manageImgs)
})

function removeActive(){
    li.forEach(el=>{
        el.classList.remove("active")
        this.classList.add("active")
    })
}

function manageImgs() {
    imgBox.forEach((el) => {
        console.log(el)
        el.style.display = "none";
    });
    document.querySelectorAll(this.dataset.cat).forEach((el) => {
      el.style.display = "block";
    });
  }


// let form = document.getElementById("form")
// let username =document.querySelector('[name="name"]');
// let email =document.querySelector("#email");
// let emailErr = document.querySelector(".emailErr")
// let nameErr = document.querySelector(".nameErr")

// form.addEventListener("submit", x=>{
//     let nameValid = false
//     let emailValid = false

//     if((username.value.length > 0 && username.value !=="")){
//         nameValid = true
//     }else{
//         nameErr.innerHTML = "Please enter your name"
//     }
//     if(email.value.length > 0){
//         emailValid = true
//     }else{
//         emailErr.innerHTML = "Please enter your email"
//     }

//     if(nameValid ===false || emailValid === false){
//         x.preventDefault()
//     }
// })

let form = document.querySelector('#form');
let reqinputs = document.querySelectorAll('.content form .main-input')

// console.log(reqinputs);

form.onsubmit = (e) => {
    // e.preventDefault();
    reqinputs.forEach(el => {
        if(el.dataset.rule) {
            let rules = el.dataset.rule.split('|');

            // console.log(rules);
            rules.forEach(r => {
                if( r.indexOf(':') == -1 ) {
                    if(r == 'required') {
                        if(el.value == '') {
                            e.preventDefault()
                            el.parentNode.querySelector('span').style.display = 'block';
                        }else {
                            el.parentNode.querySelector('span').style.display = 'none';
                        }
                    }
                }else {
                    let rs = r.split(':');
                    console.log(rs);
                    if(rs[0] == 'max') {

                        if(el.value != '' && el.value.length > rs[1]) {
                            e.preventDefault()
                            alert('Max ' + rs[1])
                        }

                    }else if(rs[0] == 'min') {
                        if(el.value != '' &&  el.value.length < rs[1]) {
                            e.preventDefault()
                            alert('Min ' + rs[1])
                        }
                    }
                }
            })
        }
        

        // if(el.value == '') {
        //     e.preventDefault()
        //     el.parentNode.querySelector('span').style.display = 'block';
        // }else {
        //     el.parentNode.querySelector('span').style.display = 'none';
        // }
    })
}