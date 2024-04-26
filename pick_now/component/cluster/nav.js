/*-------------------------
buat nav bar
-------------------------*/
// contoh array 
export const createNav = async(navArr) => {
    const container = document.getElementById(navArr.target);
    container.classList.add(navArr.tgtStyle);
    const navbar = document.createElement('div');
    navbar.id = navArr.id;
    const classes = navArr.navStyle;
    classes.forEach(cls => {
        navbar.classList.add(cls);
    })
    const main = document.createElement('div');
    main.id = navArr.mainID;
    const classes2 = navArr.mainStyle;
    classes2.forEach(cls2 => {
        main.classList.add(cls2);
    })
    navArr.navi.forEach(nav=>{
        const div = document.createElement('div');
        const classes3 = nav.divStyle;
        classes3.forEach(cls3 =>{
            div.classList.add(cls3);
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
    container.appendChild(navbar);
    container.appendChild(main);
    return 
}

/*-------------------------
check active link
-------------------------*/
export const activeLink = (target, arrCls) => {
    const container = document.getElementById(target);
    const aLink = container.querySelectorAll('a');
    aLink.forEach(link=> {
        const currentUrl = window.location.href.split('/');
        const compare = currentUrl[currentUrl.length-1];
        const hrefValue = link.getAttribute('href');
        if (hrefValue === compare) {
            const linkCh = link.childNodes;
            linkCh.forEach(n=>{
                arrCls.forEach(cls=> {
                    n.classList.add(cls);
                })
            })
        }
    })
}


