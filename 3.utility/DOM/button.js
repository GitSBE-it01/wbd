export class buttonDOM {
    constructor(key) {
        this.id = key;
    }

    async pagination (data, page) {
        try {
            const table = document.getElementById(this.id);
            const tr = table.querySelectorAll('tr');
            let count = 0;
            if(page !==1) {
                count = 100;
            }
            tr.forEach(dt=>{
                if(dt.getAttribute('data-id') !== 'header') {
                    const td = dt.querySelectorAll("[name]");
                    dt.setAttribute('data-value', count);
                    if(data[count]) {
                        dt.classList.toggle('hidden');
                    }
                    td.forEach(d2=>{
                        const key_fld = d2.getAttribute('name');
                        d2.textContent = data[count][`${key_fld}`];
                    })
                    count++;
                }
            })
        } catch(error) {
            console.error('Error:', error);
            return Promise.reject(error);
        }
    }
}
