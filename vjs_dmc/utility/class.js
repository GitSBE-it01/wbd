/*==============================================================================
CLASS LIST
Berikut adalah list CLASS yang akan di pakai di prog VJS
==============================================================================*/
class Data {
    constructor(key) {
        this.key = key;
        this.insertKey = 'insert_'+key;
        this.updateKey = 'update_'+key;
        this.deleteKey = 'delete_'+key;
        const { url, ori } = this.getUrl();
        this.url = url;
        this.ori = ori;
    }

    // for API URL 
    getUrl() {
        const check = window.location.href.split("/");
        let url ="";
        let ori = "";
        if (check[2].length > 20 ){
            url = 'http://informationsystem.sbe.co.id:8080/wbd/vjs_dmc/middleware/api.php';
            ori = 'http://informationsystem.sbe.co.id';
        } else {
            url = 'http://192.168.2.103:8080/wbd/vjs_dmc/middleware/api.php';
            ori = 'http://192.168.2.103';
        }
        return { url, ori };
    }

      /* 
      ambil data tanpa filter dari database
      tanpa imbuhan apapun contoh : 
    
      const dataDMC = await dataInput.getData();
      */
    async getData() {
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify({action: 'getData', parameters: this.key})
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

      /* 
      ambil data dengan filter dari database
      menggunakan object contoh : 
    
      const dataDMC = await dataInput.fetchDataFilter({
            assetno: valueInp[0], 
            assetkat:valueInp[1], 
            input_date:currentDate()
        });
      */
      async fetchDataFilter(filter) {
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify({action: 'fetchDataFilter', parameters: this.key, filter})
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

      /* 
      insert data ke database
      menggunakan utk filter dan field yang di tambahkan data di masukkan dalam bentuk object contoh : 
    
      const dataDMC = await dataInput.insertData(
        {
            assetno: valueInp[0], 
            assetkat:valueInp[1], 
            input_date:currentDate()
        }
        );
      */
      async insertData(insert) {
        const keys = Object.keys(insert);
        const values = Object.values(insert);
        const insertFilter=[];
        for (let i=0; i<keys.length; i++) {
            const entry = { [keys[i]]: values[i] };
            insertFilter.push(entry);
        }
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify({action: 'insertData', parameters: this.insertKey, insertFilter})
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = await response.text();
            return result;
        } catch (error) {
            console.error('Error:', error);
            return Promise.reject(error);
        }
      }

      /* 
      update data ke database
      menggunakan utk filter dan field yang di tambahkan data di masukkan dalam bentuk object contoh : 
    
      const dataDMC = await dataInput.updateData(
        update:{
                assetno: valueInp[0], 
                assetkat:valueInp[1], 
                input_date:currentDate()
            },
        filter:{
                id: 123
            }
        );
      */
      async updateData(arr) {
        const keys = Object.keys(arr.update);
        const values = Object.values(arr.update);
        const updateFilter= [];
        for (let i=0; i<keys.length; i++) {
            const entry = { [keys[i]]: values[i] };
            updateFilter.push(entry);
        }
        const keys2 = Object.keys(arr.filter);
        const values2 = Object.values(arr.filter);
        const updateFilter2=[];
        for (let i=0; i<keys2.length; i++) {
            const entry = { [keys2[i]]: values2[i] };
            updateFilter2.push(entry);
        }
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify({action: 'updateData', parameters: this.updateKey, updateFilter, updateFilter2})
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = await response.text();
            return result;
        } catch (error) {
            console.error('Error:', error);
            return Promise.reject(error);
        }
      }

      /* 
      delete data ke database
      menggunakan utk filter dan field yang di tambahkan data di masukkan dalam bentuk object contoh : 
    
      const dataDMC = await dataInput.deleteData({id: 123});
      */
      async deleteData(arr) {
        const keys = Object.keys(arr);
        const values = Object.values(arr);
        const delFilter=[];
        for (let i=0; i<keys.length; i++) {
            const entry = { [keys[i]]: values[i] };
            delFilter.push(entry);
        }
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify({action: 'deleteData', parameters: this.deleteKey, keys, values})
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = await response.text();
            return result;
        } catch (error) {
            console.error('Error:', error);
            return Promise.reject(error);
        }
      }
}

// di bawah adalah pembuatan object dengan bantuan class di atas 
export const bom= new Data('dmc_vjs');
export const dataInput= new Data('data_input');
export const dmc_vjs_log = new Data('dmc_vjs_log');
export const asset = new Data('assets');
export const vjs_asset = new Data('vjs_assets');
export const wo_list = new Data('wo_list');


