export const dtlist = (target,separator, dataArr, ...keyPick) => {
    const dtlist = document.querySelector(target);
    dataArr.forEach(dt=>{
        const key = Object.keys(dt);
        let defaultVal = '';
        let valu = '';
        if(key.length>0) {
            key.forEach(dt2=>{
                let cek = dt[dt2].toString().trim();
                defaultVal +=  cek + separator.repeat(2);
            })
            valu = defaultVal.replace(new RegExp(separator + "+$"), "");
        } else {
            valu = dt;
        }
        const option = document.createElement('option');
        if(!keyPick || keyPick === '') {
            option.value = valu;
            option.textContent = valu;
        } else {
            let val = ''
            keyPick.forEach(dt2=>{
                let cek = dt[dt2].toString().trim();
                val += cek + separator.repeat(2);
            })
            val = val.replace(new RegExp(separator + "+$"), "");
            option.value = val;
            option.textContent = val;
        }
        dtlist.appendChild(option);
    })
    return;
}

export class DtlistDOM {
    constructor(key) {
        this.key = key;
    }

    parse_option (separator, dataArr, ...keyPick) {
        const dtlist = document.querySelector(this.key);
        dataArr.forEach(dt=>{
            const key = Object.keys(dt);
            let defaultVal = '';
            let valu = '';
            if(key.length>0) {
                key.forEach(dt2=>{
                    let cek = dt[dt2] ? dt[dt2].toString().trim() : "";
                    defaultVal +=  cek + separator.repeat(2);
                })
                valu = defaultVal.replace(new RegExp(separator + "+$"), "");
            } else {
                valu = dt;
            }
            const option = document.createElement('option');
            if(!keyPick || keyPick === '') {
                option.value = valu;
                option.textContent = valu;
            } else {
                let val = ''
                keyPick.forEach(dt2=>{
                    let cek = dt[dt2] ? dt[dt2].toString().trim() : "";
                    val += cek + separator.repeat(2);
                })
                val = val.replace(new RegExp(separator + "+$"), "");
                option.value = val;
                option.textContent = val;
            }
            dtlist.appendChild(option);
        })
        return;
    }
}
