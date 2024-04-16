export function numberToString(number, minNumber, decimalMinimum) {
    const noStr = number.toString();
    const splitStr = noStr.split(".");
    const intNo = splitStr[0];
    const decNo = splitStr[1];
    let resultInt = "";
    let resultDec = "";
    if (intNo.length < minNumber) {
        const diff = minNumber - intNo.length;
        for (let i =0 ; i < diff; i++) {
            resultInt += "0";
        }
        resultInt += intNo;
    } else {
        resultInt = intNo;
    }

    if (decimalMinimum === 0) {
        return resultInt;
    }

    if (decNo.length < decimalMinimum) {
        const diff = decimalMinimum - intNo.length;
        resultDec = "." + decNo;
        for (let i =0 ; i < diff; i++) {
            resultDec += "0";
            }
        return resultInt + resultDec;
    } 

    const cek1 = decNo.substring(0, decimalMinimum);
    const cek2 = decNo.substring(decimalMinimum, decimalMinimum+1);
    const cek3 = decNo.substring(decimalMinimum, decimalMinimum+2);
    let resultCek ="";

    if (decimalMinimum === 1) {
        if (parseInt(cek2) > 4) {
            resultCek = (parseInt(cek1) + 1);
            return resultInt + resultCek.toString();  
        } 
        return resultInt + "." + cek1;
    } 
    if (parseInt(cek3) > 4) {
            resultCek = (parseInt(cek2) + 1);
            return resultInt + resultCek.toString();  
        }
    return resultDec = "." + cek1 + cek2;
}
