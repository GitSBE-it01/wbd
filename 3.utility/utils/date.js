export const currentDate = (separ) => {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2,'0');
    const day = String(today.getDate()).padStart(2,'0');
    const result = `${year}${separ}${month}${separ}${day}`
    return result;
}