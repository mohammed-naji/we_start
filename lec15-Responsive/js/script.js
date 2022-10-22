let h1 = document.querySelector('h1')

h1.innerHTML = window.innerWidth + 'px';
window.onresize = (e) => {
    h1.innerHTML = window.innerWidth + 'px';
}