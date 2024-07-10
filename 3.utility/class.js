/*==============================================================================
CLASS LIST
Berikut adalah list CLASS yang akan di pakai di prog VJS
==============================================================================*/
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
        let url =`http://${check[2]}/${check[3]}/2.backend/api.php`;
        let ori =`http://${check[2]}`;
        return { url, ori };
    }

    async dbProcess (action, data) {
        try {
            const response = await fetch(this.url, {
                method: 'POST', 
                headers: {
                  'Content-Type': 'application/json',
                  'Ori': this.ori
              },
              body: JSON.stringify({action: action, parameters: this.key, data:data})
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
