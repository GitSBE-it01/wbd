export const searchProcess = async(inpTrgt, trgtArea, fileSelect) =>{
    try {
        const inpValue = document.querySelector(inpTrgt).value;
        const target = document.querySelector(trgtArea);
        const allRow = target.querySelectorAll(`[${fileSelect}]`);
        allRow.forEach(dt=>{
            const valueCek = dt.getAttribute(`${fileSelect}`);
            dt.classList.toggle('hidden',!valueCek.toLowerCase().includes(inpValue.toLowerCase()))
        })
    }catch(error) {
        console.error('Error:', error);
        return alert('data error silahkan hubungi tim IT');
    }
}