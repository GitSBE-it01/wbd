export const pdf = async({data=[], file_name='document', layout='p', left=8, right=8, top=12, btm=8, hd=4, ft=4})=>{
    try {
        const curr = window.location.href.split("/");
        let url =`http://${curr[2]}/${curr[3]}/2.backend/pdf.php`;
        let ori = `http://${curr[2]}`;
        const response = await fetch(url, {
            method: "POST", 
            headers: {
              'Content-Type': 'application/json',
              'Ori': ori,
              'Orientation': layout,
              'margin-left': left,
              'margin-right': right,
              'margin-top': top,
              'margin-btm': btm,
              'margin-hd': hd,
              'margin-ft': ft
          },
          body: JSON.stringify({Data:data})
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const result = await response.blob();
        const result_url = URL.createObjectURL(result);
        const a = document.createElement('a');
        a.href = result_url;
        a.download = file_name;
        document.body.appendChild(a);
        a.click();
        a.remove();
        URL.revokeObjectURL(result_url);
        return result;
    } catch (error) {
        console.error('Error:', error);
        return Promise.reject(error);
    }
}
