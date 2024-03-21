/*==============================================================================
CLASS LIST
Berikut adalah list CLASS yang akan di pakai di prog VJS
==============================================================================*/
export class Data {
    constructor(db, key) {
        this.db = db
        this.key = key;
        const { url, ori } = this.getUrl();
        this.url = url;
        this.ori = ori;
        this.dt = {
            db: this.db,
            table: this.key,
        }
    }

    // for API URL 
    getUrl() {
        const check = window.location.href.split("/");
        let url ="";
        let ori = "";
        if (check[2].length > 20 ){
            url = 'http://informationsystem.sbe.co.id:8080/wbd/middleware/';
            ori = 'http://informationsystem.sbe.co.id';
        } else {
            url = 'http://192.168.2.103:8080/wbd/middleware/';
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
                method: 'GET', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
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

      /* 
      ambil data dengan filter dari database
      menggunakan object contoh : 
    
      const dataDMC = await dataInput.fetchDataFilter({
            assetno: valueInp[0], 
            assetkat:valueInp[1], 
            input_date:currentDate()
        });
      */
      async fetchDataFilter(data) {
        try {
            this.dt.filter = data;
            const fetchURL = this.url + 'post.php'
            const response = await fetch(fetchURL, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify(this.dt)
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
        const data=[];
        for (let i=0; i<keys.length; i++) {
            const entry = { [keys[i]]: values[i] };
            data.push(entry);
        }
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify({action: 'insertData', param1: this.db, param2: this.key, data})
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
              body: JSON.stringify({action: 'updateData', param1: this.db, param2: this.key, data})
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
      async deleteData(data) {
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify({action: 'deleteData', param1: this.db, param2: this.key, data})
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

      async fetchRangeFilter(data) {
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': 'http://informationsystem.sbe.co.id'
              },
              body: JSON.stringify({action: 'fetchRangeFilter', param1: this.db, param2: this.key, data})
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
}



