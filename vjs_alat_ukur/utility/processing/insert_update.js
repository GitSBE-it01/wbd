export const insertUpdateProcess = async(tableID, db_to_process) =>{
    try {
        const target = document.querySelector(tableID);
        const allRow = target.querySelectorAll('[data-id *="--change"]');
        let inputData = [];
        let updateData = [];
        allRow.forEach(dt=>{
            const cek = dt.getAttribute('data-id');
            const inp = dt.querySelectorAll('[data-field]');
            let data = {};
            inp.forEach(dt2=>{
                const key = dt2.getAttribute('data-field');
                data[key] = dt2.value.trim();
            })
            if(!cek.includes('new')) {
                const id = cek.split('--');
                const updt = {data: data, filter:id[0]};
                updateData.push(updt);
            } else {
                inputData.push(data);
            }
        })
        const message = {result: '', message: ''};
        if (inputData.length>0) {
            const result = await db_to_process.dbProcess('insert',inputData);
            if(!result.includes('fail')) {
                message.message += inputData.length +' data successfully inserted ';
                message.result += result +" ";
            } else {
                message.message += 'data fail to insert ';
                message.result += result +" ";
            }
        } 
        if (updateData.length>0) {
            const result = await db_to_process.dbProcess('update',inputData);
            if(!result.includes('fail')) {
                message.message += inputData.length +' data successfully updated ';
                message.result += result +" ";
            } else {
                message.message += 'data fail to update ';
                message.result += result +" ";
            }
        }
        return message;
    } catch(error) {
        console.error('Error:', error);
        return alert('data error silahkan hubungi tim IT');
    }
}