export const createNavbar = (target) => {
    const container = document.getElementById(target);
    const navbarVJS = document.createElement('div');
    navbarVJS.innerHTML = `<div class='navCard navbar tl2'>
    <div class='navli'>
        <a href="../../sbe/index.php">
            <button type='button' class='home'></button>
        </a>
    </div>
    <div class='navli'><a class="fc-w" href="index.php">Home</a></div>
    <div class='navli'><a class="fc-w" href="insert_cat.php">Insert category</a></div>
    </div>`;
    container.appendChild(navbarVJS);
    return navbarVJS;
}

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
