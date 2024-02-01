// utk animation loading saat tunggu proses berjalan contoh saat tarik data dari database
export const init = (target, navBar, mainColor, navBarColor) => {
    const container = document.getElementById(target);
    const main = document.createElement('div');
    main.id = 'main';
    main.classList.add(mainColor);
    const div = document.createElement('div');
    div.classList.add(navBarColor);
    container.appendChild(div);
    container.appendChild(main);
    if (navBar === 'navBar') {
        main.classList.add('navCard1');
        div.id = 'navBar';
        div.classList.add('navCard2', 'flex-r');
        return;
    } 
    if (navBar === 'side') {
        main.classList.add('sideCard1');
        div.id = 'side';
        div.classList.add('sideCard2');
        return;
    } 
    alert('parameter ada yang salah');
    return;

}

/*-------------------------
loading animasi
-------------------------*/
export const loading = (idLoad, classDiv) => {
    const div = document.createElement("div");
    div.id = idLoad;
    div.classList.add(classDiv);
    return div;
}

/*-------------------------
buat nav bar
-------------------------*/
// contoh array 
const navigation = [
    {
        link: '../../sbe/index.php',
        type: 'btn', // if btn then create a button, if txt then create span
        text: '', //if btn then empty
        divStyle:['mx5', 'mt2', 'scale-120'],
        linkStyle: ['home']
    },
    {
        link: 'index.php',
        type: 'txt', // if btn then create a button, if txt then create span
        text: 'home',
        divStyle:['ml5','mt3', 'scale-120'],
        linkStyle: ['f-tl7', 'fs-m', 'fw-blk']
    },
]

export const createNavbar = (target, navigation) => {
    const navbar = document.getElementById(target);
    navigation.forEach(nav=>{
        const div = document.createElement('div');
        const classes = nav.divStyle;
        classes.forEach(cls =>{
            div.classList.add(cls);
        })
        const a = document.createElement('a');
        a.setAttribute('href', nav.link);
        a.setAttribute('style', 'text-decoration: none;')
        if(nav.type === 'txt') {
            const span = document.createElement('span');
            span.textContent = nav.text;
            const classes2 = nav.linkStyle;
            classes2.forEach(cls =>{
                span.classList.add(cls);
            })
            a.appendChild(span);
        }
        if(nav.type === 'btn') {
            const btn = document.createElement('button');
            const classes2 = nav.linkStyle;
            classes2.forEach(cls =>{
                btn.classList.add(cls);
            })
            a.appendChild(btn);
        }
        div.appendChild(a);
        navbar.appendChild(div);
    })
    console.log(navbar);
    return navbar;
}

/*-------------------------
check active link
-------------------------*/
export const activeLink = (target) => {
    const aLink = document.querySelectorAll(target);
    aLink.forEach(link=> {
        const currentUrl = window.location.href;
        const hrefValue = link.getAttribute('href'); 
        const span = link.querySelector('span.fc-w');
        if (hrefValue === currentUrl) {
            span.classList.add('active'); // Add the new class if it matches
    }   
})}

/*
export const createSidebar = (target, array) => {
    const container = document.getElementById(target);
    container.classList.add('sidebar');
    for (let i=0; i<array.length; i++) {
        const sideli = document.createElement('div');
        sideli.classList.add('sideli');
        const aLink = document.createElement('a');
        aLink.classList.add('link');
        aLink.setAttribute('href', array[i].href);
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.id = array.id;
        btn.classList.add()
        const span =document.createElement('span');
        span.classList.add(array[i].spanClass);
        span.textContent = array[i].text;
    }
    container.appendChild(createSidebar);
    return createSidebar;
}
*/