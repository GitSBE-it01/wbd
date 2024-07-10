const auth = async() =>{
    const check = window.location.href.split("/");
    let url =`http://${check[2]}/${check[3]}/${check[4]}/backend/api.php`;
    let ori =`http://${check[2]}/`;
    fetch(url, {
            method: 'GET', 
            headers: {
                'Content-Type': 'application/json',
                'Ori': ori,
                'Pragma': 'cache',
            }
        })
    .then(response => response.text())
    .then(data =>{
        if(data.includes('failed')) {
            const check = window.location.href.split("/");
            const newURL = 'http://' + check[2] + '/sbe/index.php';
            window.location.href = newURL;
        }
    })
    .catch(error=>{
        console.error('Error:', error);
        return Promise.reject(error);
    })
}

auth();