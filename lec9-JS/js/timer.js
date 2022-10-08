let btn      = document.getElementById('btn');
let wrapper  = document.getElementById('wrapper');
let num      = document.getElementById('num');
let bar      = document.getElementById('bar');
let progress = document.getElementById('progress');

btn.addEventListener('click', function() {
    let i = num.innerHTML;
    let f = 0;
    let size = 100 / i;
    let d = setInterval(function() {
        num.innerHTML = i--;
        if(i < 0) {
            clearInterval(d);
        }
         // 20
        f += size;
        progress.style.width = f + '%';
    }, 1000)
})
