export const send_email = async({to, cc='', subject, body})=>{
    try {
        const curr = window.location.href.split("/");
        let url =`http://${curr[2]}/${curr[3]}/2.backend/api_mail.php`;
        let ori = `http://${curr[2]}`;
        const data = {to, cc, subject, body};
        const response = await fetch(url, {
            method: "POST", 
            headers: {
              'Content-Type': 'application/json',
              'Ori': ori,
          },
          body: JSON.stringify({Data:data})
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const result = await response.json();
        console.log(result);
        return result;
    } catch (error) {
        console.error('Error:', error);
        return Promise.reject(error);
    }
}
