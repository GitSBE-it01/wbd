export const showDelBtn = async(event, tableId, data, db_to_process) =>{
    const btn = event.target;
    btn.classList.toggle('font-bold');
    btn.classList.toggle('border-b-4');
    btn.classList.toggle('border-r-4');
    btn.classList.toggle('pt-[.2rem]');
    btn.classList.toggle('border-teal-500');
    try {
        const target = document.querySelector(tableId);
        const allRow = target.querySelectorAll(`[data-delbtn]`);
        if(!btn.classList.contains('bg-red-500')) {
            allRow.forEach(dt=>{
                dt.classList.toggle('hidden');
            })
            return;
        } else {
            console.log('prepare delete data')
            const message = {message:'', result:''};
            if (data.length>0) {
                const result = await db_to_process.dbProcess('delete',data);
                if(!result.includes('fail')) {
                    message.message += data.length +' data successfully deleted ';
                    message.result += result + " ";
                    btn.classList.toggle('bg-red-500');
                    btn.classList.toggle('font-bold');
                    btn.classList.toggle('border-b-4');
                    btn.classList.toggle('border-r-4');
                    btn.classList.toggle('pt-[.2rem]');
                    btn.classList.toggle('border-teal-500');
                    data=[];
                    alert(message.message);
                    location.reload();
                    return;
                } else {
                    message.message += 'data fail to delete ';
                    message.result += result +" ";
                    alert (message.message);
                    return;
                }
            } else {
                message.message += 'no data to delete';
                alert (message.message);
                return;
            }
        }
    }catch(error) {
        console.error('Error:', error);
        return;
    }
}

export const del_process = async(event, masterBtn, array, result) =>{
    try{
        const target = event.target;
        const closestTr = target.closest('tr');
        let val = closestTr.getAttribute('data-id');
        let key = '';
        array.forEach(dt=>{
            if(dt.pk !== undefined) {
                key = dt.field;
            }
        })
        const del_btn = document.querySelector(masterBtn);
        if(target.classList.contains('minus')) {
            const data = {};
            data[`${key}`] = val;
            result.push(data);
            target.classList.toggle('minus');
            target.classList.toggle('minus_red');
            del_btn.classList.toggle('bg-red-500', result.length>0);
            return result;
        } else {
            target.classList.toggle('minus');
            target.classList.toggle('minus_red');
            for(let i=0; i<result.length; i++) {
                if(result[i][`${key}`] && result[i][`${key}`] === val) {
                    result.splice(i,1);
                    del_btn.classList.toggle('bg-red-500', result.length>0);
                    return result;
                }
            }
        }
    } catch(error){
        console.error('error: ', error);
        return;
    }
}

export const del_form_process = async(idTarget, event, masterBtn, key, result) =>{
    try{
        const target = event.target;
        const id = target.getAttribute(idTarget);
        const idVal = id.split('__');
        const del_btn = document.querySelector(masterBtn);
        if(target.classList.contains('minus')) {
            const data = {};
            data[`${key}`] = idVal[1];
            result.push(data);
            target.classList.toggle('minus');
            target.classList.toggle('minus_red');
            del_btn.classList.toggle('bg-red-500', result.length>0);
            return result;
        } else {
            target.classList.toggle('minus');
            target.classList.toggle('minus_red');
            for(let i=0; i<result.length; i++) {
                if(result[i][`${key}`] && result[i][`${key}`] === idVal[1]) {
                    result.splice(i,1);
                    del_btn.classList.toggle('bg-red-500', result.length>0);
                    return result;
                }
            }
        }
    } catch(error){
        console.error('error: ', error);
        return;
    }
}