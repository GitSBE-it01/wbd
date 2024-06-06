const auth = async() =>{
    sessionStorage.clear();
    const check = window.location.href.split("/");
    let url =`http://${check[2]}/${check[3]}/${check[4]}/backend/api.php`;
    let ori =`http://${check[2]}`;
    fetch(url, {
            method: 'GET', 
            headers: {
                'Content-Type': 'applicatio n/json',
                'Ori': ori
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

auth();