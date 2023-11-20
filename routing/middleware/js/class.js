/*==============================================================================
CLASS LIST
Berikut adalah list CLASS yang akan di pakai di prog VJS
==============================================================================*/
class Data {
    constructor(key) {
        this.key = key;
        this.insertKey = 'insert_'+key;
        this.updateKey = 'update_'+key;
    }

    async getData() {
        try {
            const response = await fetch('http://192.168.2.103:8080/wbd/routing/middleware/php/api.php', {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json'
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
      contoh penggunaan fetchDataFilter(arrKey, arrValue) :                
      variable arrKey di isi dengan index kolom yang di filter dan di buat dalam bentuk array
      const arrKey = ['fromdiv', 'asset_vjs_kategori'] 

      variable arrValue di isi dengan kata2 filter yang akan di filter
      const arrValue = ['PRODUCTION SPEAKER ASSEMBLY','IS NOT NULL' ]
      note : hanya kata2 yang sama persis bukan dimulai dari atau terdiri dari
      
      contoh penggunaan utk mendapatkan data dengan menggunakan class method
      const data = await relation.fetchDataFilter(arrKey, arrValue)
      */
      async fetchDataFilter(filter) {
        try {
            const response = await fetch('http://192.168.2.103:8080/wbd/routing/middleware/php/api.php', {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json'
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

      async insertData(insert) {
        const keys = Object.keys(insert);
        const values = Object.values(insert);
        const insertFilter=[];
        for (let i=0; i<keys.length; i++) {
            const entry = { [keys[i]]: values[i] };
            insertFilter.push(entry);
        }
        try {
            const response = await fetch('http://192.168.2.103:8080/wbd/routing/middleware/php/api.php', {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json'
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

      async updateData(update, filter) {
        const keys = Object.keys(update);
        const values = Object.values(update);
        const updateFilter=[];
        for (let i=0; i<keys.length; i++) {
            const entry = { [keys[i]]: values[i] };
            updateFilter.push(entry);
        }
        const keys2 = Object.keys(filter);
        const values2 = Object.values(filter);
        const updateFilter2=[];
        for (let i=0; i<keys2.length; i++) {
            const entry = { [keys2[i]]: values2[i] };
            updateFilter2.push(entry);
        }
        try {
            const response = await fetch('http://192.168.2.103:8080/wbd/routing/middleware/php/api.php', {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json'
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
}

// di bawah adalah pembuatan object dengan bantuan class di atas 
export const routing_ori = new Data('routing_ori');
export const insert_routing_ori = new Data('insert_routing_ori');
export const update_routing_ori = new Data('update_routing_ori');
export const routing_alter = new Data('routing_alter');
export const insert_routing_alter = new Data('insert_routing_alter');
export const update_routing_alter = new Data('update_routing_alter');
export const log_routing = new Data('log_routing');
export const insert_log_routing = new Data('insert_log_routing');
export const update_log_routing = new Data('update_log_routing');
