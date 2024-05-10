/*==============================================================================
CLASS LIST
Berikut adalah list CLASS yang akan di pakai di prog VJS
==============================================================================*/
export class Data2 {
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
            url = 'http://informationsystem.sbe.co.id:8080/wbd/pick_now/backend/api.php';
            ori = 'http://informationsystem.sbe.co.id';
        } else {
            url = 'http://192.168.2.103:8080/wbd/pick_now/backend/api.php';
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
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify({action: 'insertData', parameters: this.key, insert})
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
      async updateData(update) {
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify({action: 'updateData', parameters: this.key, update})
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
      async deleteData(delFilter) {
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify({action: 'deleteData', parameters: this.key, delFilter})
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



export class Data {
    constructor(key) {
        this.key = key;
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
            url = 'http://informationsystem.sbe.co.id:8080/wbd/pick_now/backend/api.php';
            ori = 'http://informationsystem.sbe.co.id';
        } else {
            url = 'http://192.168.2.103:8080/wbd/pick_now/backend/api.php';
            ori = 'http://192.168.2.103';
        }
        return { url, ori };
    }

    async dbProcess (action, data, cache) {
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify({action: action, parameters: this.key, data, cache})
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = await response.json();
            return result;
        } catch (error) {
            const errorJson = JSON.stringify(error);
            return errorJson;
        }
      }
}

