// utk animation loading saat tunggu proses berjalan contoh saat tarik data dari database
export const init = (target, navBar, mainColor, navBarColor) => {
    const container = document.getElementById(target);
    const main = document.createElement('div');
    main.id = 'main';
    main.classList.add(mainColor);
    const div = document.createElement('div');
    div.classList.add(navBarColor);
    if (navBar === 'navBar') {
        main.classList.add('main2');
        div.classList.add('navCard');
        div.id = 'navBar';
    } else if (navBar === 'side') {
        main.classList.add('main');
        div.classList.add('sideCard');
        div.id = 'side';
    } else { 
        alert('yang anda masukkan salah');
    }
    container.appendChild(div);
    container.appendChild(main);
}

export const loading = (idLoad, classDiv) => {
    const div = document.createElement("div");
    div.id = idLoad;
    div.classList.add(classDiv);
    return div;
}

