/*==============================================================================
CLASS LIST
Berikut adalah list CLASS yang akan di pakai di prog VJS
==============================================================================*/
class Data {
    constructor(key) {
        this.key = key;
        this.insertKey = 'insert_'+key;
        this.updateKey = 'update_'+key;
        this.delKey = 'delete_'+key;
    }

    async getData() {
        try {
            const response = await fetch('http://192.168.2.103:8080/wbd/routing/api.php', {
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
            const response = await fetch('http://192.168.2.103:8080/wbd/routing/api.php', {
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
            const response = await fetch('http://192.168.2.103:8080/wbd/routing/api.php', {
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
            const response = await fetch('http://192.168.2.103:8080/wbd/routing/api.php', {
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

      
      async deleteData(del) {
        const keys = Object.keys(del);
        const values = Object.values(del);
        const delFilter=[];
        for (let i=0; i<keys.length; i++) {
            const entry = { [keys[i]]: values[i] };
            delFilter.push(entry);
        }
        try {
            const response = await fetch('http://192.168.2.103:8080/wbd/routing/api.php', {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({action: 'delData', parameters: this.delKey, delFilter})
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
export const access = new Data('access');
export const user = new Data('user');
export const list_location = new Data('list_location');
export const jig_master_query = new Data('jig_master_query');
export const log_master_query = new Data('log_master_query');
export const jig_location_query = new Data('jig_location_query');
export const log_location_query = new Data('log_location_query');
export const jig_function_query = new Data('jig_function_query');
export const log_function_query = new Data('log_function_query');
export const item_detail_query = new Data('item_detail_query');
