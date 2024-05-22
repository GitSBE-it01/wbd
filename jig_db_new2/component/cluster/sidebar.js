/*-------------------------
buat nav bar
-------------------------*/
// main navigation 
import { create } from "../block.js";

const linkArr = (roleUser) => {
    const dataLink = [
        {text: 'Home', link:`../jig_db_new/index.php`},
        {text: 'Transaction', link:`../jig_db_new/transaksi/`},
        {text: 'Usage', link:`../jig_db_new/usage/`},
    ]
    if (roleUser === 'admin' || roleUser === 'superuser') {
        const insert1 = {text: 'Update Data & Stock', link:`../jig_db_new/update/`};
        dataLink.splice(1,0,insert1);
        const insert2 = {text: 'Add New', link:`add_data.php`}
        dataLink.push(insert2);
    }
    if (roleUser === 'superuser') {
        const insert = {text: 'User', link:`../jig_db_new/user/`};
        dataLink.push(insert);
    } 
    return dataLink;
}


const home = () => {
    const homeArr = {text: 'mainMenu', link:`../../sbe/index.php?cek=no`}
    create({
        element: 'a',
        selector: `#side`,
        nav: homeArr.text,
        href: homeArr.link,
        style: `
            margin: 1.5rem .7rem .7rem .7rem;
            text-decoration: none;
            `
    })
    create({
        element: 'button',
        selector: `[data-nav ="${homeArr.text}"]`,
        class: 'home2',
    })
}

export const sideNav = async() => {
    await create({
        element: 'div',
        selector: '#root',
        id: 'side',
        style: `
            background-color:#1c1f2b;
            width: 14vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: left;
            padding: 1rem;`
    })
    const role = document.getElementById('role').value;
    const dataLink = linkArr(role);
    dataLink.forEach(dt=>{
        create({
            element: 'a',
            selector: `#side`,
            nav: dt.text,
            href: dt.link,
            style: `
                margin: 1.5rem .3rem .7rem 0;
                text-decoration: none;
                color: azure;
            `,
            textCont: dt.text,
            onmouseover: 'hover(this, "font-size: 1.2rem; font-weight:700")',
            onmouseout:'hoverOut(this, "font-size: 1.2rem; font-weight:700")'
        })
    })
    home();
}
    





