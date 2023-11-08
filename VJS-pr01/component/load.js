// utk animation loading saat tunggu proses berjalan contoh saat tarik data dari database
export const loading = (idLoad) => {
    const div = document.createElement("div");
    div.id = idLoad;
    div.classList.add('loading2', 'grid-mainFull1');
    return div;
}
