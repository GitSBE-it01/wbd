export const createNavbar = (navbarHTML) => {
    //const container = document.getElementById(target);
    const navbar = document.createElement('div');
    navbar.innerHTML = navbarHTML;
    //container.appendChild(navbar);
    return navbar;
}

