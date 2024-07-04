export const activeLink = (cls) => {
    const container = document.querySelector('nav');
    const ul = container.querySelector('ul');
    const aLink = ul.querySelectorAll('a');
    let styleClass = "h-full w-[10vw] text-white justify-center items-center flex hover:bg-slate-700 duration-200 ease-in-out hover:border-blue-500 hover:font-semibold hover:border-b-4 bg-blue-800 border-blue-300 border-b-4 font-semibold";
    if(cls!=='') {
        styleClass = cls;
    }
    aLink.forEach(link=> {
        const currentUrl = window.location.href.split('/');
        const compare = currentUrl[currentUrl.length-1];
        const hrefValue = link.getAttribute('href');
        if (hrefValue === compare) {
            link.setAttribute('class', styleClass);
        }
    })
}