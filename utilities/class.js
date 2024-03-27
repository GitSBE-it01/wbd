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
            url = 'http://informationsystem.sbe.co.id:8080/wbd/backend/API.php';
            ori = 'http://informationsystem.sbe.co.id';
        } else {
            url = 'http://192.168.2.103:8080/wbd/backend/API.php';
            ori = 'http://192.168.2.103';
        }
        return { url, ori };
    }
      /* 
      fetch data dari database
        const fetch = {
            first_name:'hello'
        }
      */
    async fetch(data) {
        try {
            const filter = new URLSearchParams(data)
            const fetchURL = this.url + "/" + this.dt.db + "." + this.dt.table + "?" + filter.toString();
            const response = await fetch(fetchURL, {
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
      insert data ke database
      menggunakan utk filter dan field yang di tambahkan data di masukkan dalam bentuk object contoh : 
    
    const insertDt = {
            first_name:['hello','Redo'],
            last_name:['world', 'test']
        }
      */
      async insert(data) {
        try {
            this.dt.data = data;
            const response = await fetch(this.url, {
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
            const result = await response.json();
            return result;
        } catch (error) {
            console.error('Error:', error);
            return Promise.reject(error);
        }
      }

      /* 
      update data ke database
      menggunakan utk filter dan field yang di tambahkan data di masukkan dalam bentuk object contoh : 
    
    const updateDt = {
        data: {
            last_name:['world', 'test']
        },
            filter: {
                id: [7,8]
            }
        }
      */
      async update(data) {
        try {
            this.dt.data = data['data'];
            this.dt.filter = data['filter'];
            const response = await fetch(this.url, {
                method: 'PUT', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify(this.dt)
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
      delete data ke database
      menggunakan utk filter dan field yang di tambahkan data di masukkan dalam bentuk object contoh : 
    
    const deleteDt = {
        last_name: ['Smith']
        }
      */
      async delete(data) {
        try {
            this.dt.data = data;
            const response = await fetch(this.url, {
                method: 'DELETE', 
                headers: {
                  'Content-Type': 'application/json',
                  'Origin': this.ori
              },
              body: JSON.stringify(this.dt)
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



