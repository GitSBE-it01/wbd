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
        main.classList.add('main2');
        div.classList.add('navCard');
        div.id = 'navBar';
        return;
    } 
    if (navBar === 'side') {
        main.classList.add('main');
        div.classList.add('sideCard');
        div.id = 'side';
        return;
    } 
    alert('yang anda masukkan salah');
    return;

}

export const loading = (idLoad, classDiv) => {
    const div = document.createElement("div");
    div.id = idLoad;
    div.classList.add(classDiv);
    return div;
}

export const createNavbar = (target, navbarHTML) => {
    const container = document.getElementById(target);
    container.classList.add('navbar');
    const navbar = document.createElement('div');
    navbar.innerHTML = navbarHTML;
    //container.appendChild(navbar);
    return navbar;
}


const array = {
    href:[],
    btn_txt:[{
        spanClass:[],
        text:[],
    }]
};

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
