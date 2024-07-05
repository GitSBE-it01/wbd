export const api_access = async(action, data, table) =>{
    const check = window.location.href.split("/");
    let url =`http://${check[2]}/${check[3]}/2.backend/api.php`;
    let resp = '';
    if(action === 'get') {resp = await get(url, table, "GET")};
    if(action === 'fetch') {resp = await execute(url, table, "POST", data)};
    if(action === 'insert') {resp = await execute(url, table, "POST", data)};
    if(action === 'update') {resp = await execute(url, table, "PUT", data)};
    if(action === 'delete') {resp = await execute(url, table, "DELETE", data)};
    return resp;
}

const get = async(url, table, action) => {
    try {
        table
        const response = await fetch(url, {
            method: action, 
            headers: {
              'Content-Type': 'application/json',
              'Req-Detail': table,
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

const execute = async(url, table,  action, data)=>{
    try {
        const response = await fetch(url, {
            method: action, 
            headers: {
              'Content-Type': 'application/json',
              'Req': table,
          },
          body: JSON.stringify({data:data})
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

