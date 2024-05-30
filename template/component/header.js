export const navbar = (array) =>{
    const check = window.location.href.split("/");
    let url =`http://${check[2]}/sbe/index.php`;

    const header = document.querySelector('header');
    const nav = document.createElement('nav');
    nav.setAttribute('class', "flex flex-row items-center list-none h-full")
    const li = document.createElement('li');
    li.setAttribute('class', "h-full hover:text-2xl hover:pt-2 hover:bg-slate-700 duration-200 pt-2 pl-10 pr-10 ease-in-out hover:border-b-4 hover:border-teal-300")
    const a = document.createElement('a');
    a.setAttribute('class', "ease-in-out duration-200 ")
    a.setAttribute('href', url);
    const btn = document.createElement('button');
    btn.classList.add('home');
    a.appendChild(btn);
    li.appendChild(a);
    nav.appendChild(li);
    array.forEach(dt=>{    
        const li = document.createElement('li');
        li.setAttribute('class', "h-full hover:pt-2 hover:px-9 hover:bg-slate-700 duration-200 text-base pt-3 px-10 ease-in-out hover:border-b-4 hover:border-teal-300")
        const a = document.createElement('a');
        a.setAttribute('class', "text-white text-base ease-in-out duration-200")
        a.setAttribute('href', dt.link);
        a.textContent = dt.text;
        li.appendChild(a);
        nav.appendChild(li);
    })
    header.appendChild(nav);
}