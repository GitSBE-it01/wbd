export const currentDate = (separ) => {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2,'0');
    const day = String(today.getDate()).padStart(2,'0');
    const result = `${year}${separ}${month}${separ}${day}`
    return result;
}

export const getCustomDate = (number, separ) => {
    let dayDate = new Date();
    dayDate.setDate(dayDate.getDate() + (number));
    const year = dayDate.getFullYear();
    const month = String(dayDate.getMonth() + 1).padStart(2,'0');
    const day = String(dayDate.getDate()).padStart(2,'0');
    const result = `${year}${separ}${month}${separ}${day}`
    return result;
}


export const customPeriod = (inpt_dt) =>{
    let splt = inpt_dt.split('-');
    let period = splt[0]+".b"+splt[1].padStart(2,'0');
    return period;
}
