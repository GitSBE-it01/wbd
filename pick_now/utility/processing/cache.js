export const delete_cache = async() => {
    const check = window.location.href.split("/");
    let url =`http://${check[2]}/${check[3]}/${check[4]}/backend/api.php`;
    let ori =`http://${check[2]}`;
    try {
        const response = await fetch(url, {
            method: 'DELETE', 
            headers: {
                'Content-Type': 'application/json',
                'Ori': ori
            },
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const result = await response.json();
        return result;
    } catch (error) {
        console.error('Error:', error);
        return Promise.reject(error);
    }
}

export const cache = async(name, data) => {
    const check = window.location.href.split("/");
    let url =`http://${check[2]}/${check[3]}/${check[4]}/backend/api.php`;
    let ori =`http://${check[2]}`;
    try {
        const response = await fetch(url, {
            method: 'PUT', 
            headers: {
                'Content-Type': 'application/json',
                'Ori': ori
            },
            body: JSON.stringify({parameters: name, data})
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const result = await response.json();
        return result;
    } catch (error) {
        console.error('Error:', error);
        return Promise.reject(error);
    }
}


export const get_cache = async(name) => {
    const check = window.location.href.split("/");
    let url =`http://${check[2]}/${check[3]}/${check[4]}/backend/api.php`;
    let ori =`http://${check[2]}`;
    try {
        const response = await fetch(url, {
            method: 'GET', 
            headers: {
                'Content-Type': 'application/json',
                'Ori': ori,
                'Req-Detail': table,
                'Req-Method': fix_action,
                'Cache-Control': cache
            }
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const result = await response.json();
        return result;
    } catch (error) {
        console.error('Error:', error);
        return Promise.reject(error);
    }
}


