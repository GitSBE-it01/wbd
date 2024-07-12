export const api_access = async(action, table, data) =>{
    const check = window.location.href.split("/");
    let url =`http://${check[2]}/${check[3]}/2.backend/api.php`;
    let resp = '';
    if(action === 'get') {resp = await get(url, table, "get","GET")}
    else if(action.includes('fetch')) {resp = await execute(url, table,action, "POST", data);}
    else if(action.includes('insert')) {resp = await execute(url, table,action, "POST", data)}
    else if(action.includes('update')) {resp = await execute(url, table,action, "PUT", data)}
    else if(action.includes('delete')) {resp = await execute(url, table,action, "DELETE", data)}
    else {resp = await execute(url, table,'custom', "POST", data)}
    return resp;
}

const get = async(url, table, action, method) => {
    try {
        const response = await fetch(url, {
            method: method, 
            headers: {
              'Content-Type': 'application/json',
              'Req-Detail': table,
              'Req-Method': action
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

const execute = async(url, table, action, method, data)=>{
    try {
        const response = await fetch(url, {
            method: method, 
            headers: {
              'Content-Type': 'application/json',
              'Req-Detail': table,
              'Req-Method': action
          },
          body: JSON.stringify({Data:data})
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

