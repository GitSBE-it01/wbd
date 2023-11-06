// utk animation loading saat tunggu proses berjalan contoh saat tarik data dari database
export const loading = (idLoad, classDiv) => {
    const div = document.createElement("div");
    div.id = idLoad;
    div.classList.add(classDiv);
    return div;
}

