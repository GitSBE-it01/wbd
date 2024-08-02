const auth = () =>{
    sessionStorage.clear();
    const check = window.location.href.split("/");
    let url =`http://${check[2]}/${check[3]}/2.backend/auth.php`;
    let ori =`http://${check[2]}`;
    fetch(url, {
            method: 'GET', 
            headers: {
                'Content-Type': 'application/json',
                'Ori': ori,
            }
        })
    .then(response => response.json())
    .then(data =>{
        if(typeof data === 'string' && data.includes('failed')) {
            const check = window.location.href.split("/");
            const newURL = 'http://' + check[2] + '/sbe/index.php';
            window.location.href = newURL;
        } else {
            sessionStorage.setItem('userData', JSON.stringify(data));
        }
    })
    .catch(error=>{
        console.error('Error:', error);
        return Promise.reject(error);
    })
}

export const auth2 = async() =>{
    sessionStorage.clear();
    const check = window.location.href.split("/");
    let url =`http://${check[2]}/${check[3]}/2.backend/auth.php`;
    let ori =`http://${check[2]}`;
    try {
        const response = await fetch(url, {
            method: 'GET', 
            headers: {
                'Content-Type': 'application/json',
                'Ori': ori,
            }
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        const check = window.location.href.split("/");
        const newURL = 'http://' + check[2] + '/sbe/index.php';
        if(typeof data === 'string' && data.includes('failed')) {
            window.location.replace(newURL);
            return;
        } else {
            sessionStorage.setItem('userData', JSON.stringify(data));
            return;
        }
    } catch (error) {
        console.error('Error:', error);
        return Promise.reject(error);
    }
}
