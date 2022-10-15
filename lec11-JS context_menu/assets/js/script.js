

let toggleColor = document.querySelector('#toggleColor'),
    body = document.querySelector('body'),
    customMenu = document.querySelector(".custom-menu");


// dark mode event
// let getTheme = JSON.parse(localStorage.getItem('theme'));
let getTheme = localStorage.getItem('theme');
if(getTheme === 'dark') {
    body.classList.add('dark');
}

// {
//     items: {
//         fff,
//         mmm
//     },
//     total: 100
// }

toggleColor.onclick = () => {
    body.classList.toggle('dark');
    let theme;
    if(body.classList.contains('dark')) {
        theme = 'dark'
    } else {
        theme = 'light'
    }

    // localStorage.setItem('theme', JSON.stringify(theme));
    localStorage.setItem('theme', theme);
}




// context menu
window.oncontextmenu = (e) => {
    console.log(e);
    e.preventDefault();
    
    let xPosition = e.clientX,
        yPosition = e.clientY,
        windowWidth = window.innerWidth,
        windowHeight = window.innerHeight,
        menuWidth = 200,
        menuHeight = customMenu.offsetHeight;

        console.log(menuWidth);

        // menu position
        xPosition = xPosition > windowWidth - menuWidth ? windowWidth - menuWidth : xPosition;
        yPosition = yPosition > windowHeight - menuHeight ? windowHeight - menuHeight  : yPosition;

        // customMenu.style.left =  `${xPosition}px`;
        // customMenu.style.top =  `${yPosition}px`;
        // customMenu.style.display = 'block';
        customMenu.style.cssText = `
            left: ${xPosition}px;
            top: ${yPosition}px;
            display: block;
        `
    }


customMenu.onclick = (e) => e.stopPropagation();
document.onclick = () => customMenu.style.display = 'none'

document.onkeyup = (e) => {
    console.log(e);
    if(e.keyCode == 27) {
        customMenu.style.display = 'none';
    }
}


