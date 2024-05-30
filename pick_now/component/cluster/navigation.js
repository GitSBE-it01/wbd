export const navigation = (text, array) =>{
    const check = window.location.href.split("/");
    const target = document.querySelector('body');
    const nav = document.createElement('nav');
    nav.setAttribute('class', "fixed flex flex-row top-0 items-center bg-slate-950 w-screen h-[5vh]")
    nav.appendChild(home(check));
    nav.appendChild(link(check, array));
    nav.appendChild(main_title(text));
    target.appendChild(nav);
}

const main_title = (text) =>{
    const h1 = document.createElement('h1');
    h1.textContent = text;
    h1.setAttribute('class', 'text-2xl underline h-full w-full pt-2 capitalize font-bold italic text-slate-200 text-right mr-[2vw]');
    return h1;
}

const home = (check) =>{
    let url =`http://${check[2]}/sbe/index.php`;
    const li = document.createElement('li');
    li.setAttribute('class', "list-none w-[10vw] h-full hover:pt-2 hover:bg-slate-700 duration-200 pt-2 pl-10 pr-10 ease-in-out hover:border-b-4 hover:border-teal-300")
    const a = document.createElement('a');
    a.setAttribute('href', url);
    const btn = document.createElement('button');
    btn.setAttribute('class','home h-8 w-8 bg-transparent');
    a.appendChild(btn);
    li.appendChild(a);
    return li;
}

const link = (check, array) =>{
    const ul = document.createElement('ul');
    ul.setAttribute('class', 'w-full h-full flex flex-row');
    array.forEach(dt=>{    
        const li = document.createElement('li');
        const a = document.createElement('a');
        if(check[5] === dt.link) {
            li.setAttribute('class', "h-full w-[10vw] pt-2 justify-center flex hover:bg-slate-700 duration-200 ease-in-out hover:border-teal-300 font-semibold bg-teal-600 border-b-4 border-slate-200 ")
        } else {
            li.setAttribute('class', "h-full w-[10vw] pt-3 justify-center flex hover:bg-slate-700 duration-200 ease-in-out hover:border-teal-300 hover:font-semibold hover:border-b-4 hover:pt-2 ")
        }
        a.setAttribute('class', "text-white ease-in-out duration-200")
        a.setAttribute('href', dt.link);
        a.textContent = dt.text;
        li.appendChild(a);
        ul.appendChild(li);
    })
    return ul;
}