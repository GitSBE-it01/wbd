export const result_check = (data) => {
    const body = document.querySelector('body');
    const separator1 = '==========================================';
    const separator2 = '----------------------------';
    data.forEach(d=>{
        const div1 = document.createElement('div');
        const ttl_div1 = document.createElement('h3');
        ttl_div1.setAttribute('class', 'text-xl font-semibold');
        if(Array.isArray(d.data_array)) {
            ttl_div1.innerHTML = separator1+"</br>"+d.title+"</br>"+separator1+"</br>data count: "+ d.data_array.length;
            for (let i=0; i<2; i++) {
                const dt = d['data_array'][i];
                let text = "</br> data ke " + i+"</br>"+separator2+"</br>";
                if(dt !== undefined) {
                    if(typeof dt === 'string') {
                        text += dt+', ';
                    } else {
                        const key = Object.keys(dt);
                        key.forEach(dd=>{
                            text += `${dd} = ${dt[dd]}`+"</br>";
                        })
                    }
                }
                const div_isi = document.createElement('div');
                div_isi.innerHTML = text+separator2+"</br>";
                div1.appendChild(div_isi);
            }
            body.appendChild(ttl_div1);
            body.appendChild(div1);
            console.log(separator1);
            console.log(d.title);
            console.log(separator2);
            console.log(d.data_array);
            console.log(separator1);
            return;
        }
        if(!Array.isArray(d.data_array) && typeof d.data_array === 'object') {
            const data_key = Object.keys(d.data_array);
            ttl_div1.innerHTML = separator1+"</br>"+d.title+"</br>"+separator1+"</br>data count: "+ data_key.length;
            for (let i=0; i<2; i++) {
                const dt = data_key[i];
                const key = Object.keys(dt);
                console.log(key);
                let text = '';
                if(key.length === 0 ) {
                    text = "</br> data ke " + i+" = "+dt+"</br>";
                } else {
                    text = "</br> data ke " + i+"</br>"+separator2+"</br>";
                    key.forEach(dd=>{
                        text += `${dd} = ${dt[dd]}`+"</br>";
                    })
                }
                const div_isi = document.createElement('div');
                div_isi.innerHTML = text+separator2+"</br>";
                div1.appendChild(div_isi);
            }
            body.appendChild(ttl_div1);
            body.appendChild(div1);
            console.log(separator1);
            console.log(d.title);
            console.log(separator2);
            console.log(d.data_array);
            console.log(separator1);
            return;
        }
    })
}