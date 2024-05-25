const auth = async() =>{
    const check = window.location.href.split("/");
    let url ="";
    let ori = "";
    if (check[2].length > 20 ){
        url = 'http://informationsystem.sbe.co.id:8080/wbd/template/backend/api.php';
        ori = 'http://informationsystem.sbe.co.id';
    } else {
        url = 'http://192.168.2.103:8080/wbd/template/backend/api.php';
        ori = 'http://192.168.2.103';
    }
    console.log({url, ori});
    try {
        const response = await fetch(url, {
            method: 'GET', 
            headers: {
                'Content-Type': 'application/json',
                'Ori': ori
            }
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

auth();