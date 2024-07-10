export const api_access = async(action, table, data) =>{
    const check = window.location.href.split("/");
    let url =`http://${check[2]}/${check[3]}/2.backend/api.php`;
    let resp = '';
    if(action === 'get') {resp = await get(url, table, "get","GET")};
    if(action === 'fetch') {resp = await execute(url, table,'fetch', "POST", data)};
    if(action === 'insert') {resp = await execute(url, table,'insert', "POST", data)};
    if(action === 'update') {resp = await execute(url, table,'update', "PUT", data)};
    if(action === 'delete') {resp = await execute(url, table,'delete', "DELETE", data)};
    if(action === 'get2') {resp = await get(url, table, "get2","GET")};
    if(action === 'fetch2') {resp = await execute(url, table,'fetch2', "POST", data)};
    if(action === 'insert2') {resp = await execute(url, table,'insert', "POST", data)};
    if(action === 'update2') {resp = await execute(url, table,'update', "PUT", data)};
    if(action === 'delete2') {resp = await execute(url, table,'delete', "DELETE", data)};
    if(action === 'custom') {resp = await execute(url, table,'custom', "POST", data)};
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

