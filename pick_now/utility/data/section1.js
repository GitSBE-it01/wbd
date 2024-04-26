export const dataSection1 = async(data) => {
    // p1.assy, prod1.vc WHPR
    const result = [];
    data.forEach(dt=>{
        if(dt.dept === 'P1.ASSY' && dt.dept === 'PROD1.VC' && dt.dept === 'WHPR' ) {
            result.push(dt);
        }
    })
    return result;
}