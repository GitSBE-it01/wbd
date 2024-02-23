
const disabledBtn= () =>{
    const btntarget = document.getElementById('dmcInput');
    const btnSelf = document.getElementById('dmcEdit');
    btnSelf.disabled = true;
    btntarget.disabled = false;
    return;
}

const opClHide = () => {
    const btnOpen = document.getElementById('mainDMC');
    if(btnOpen.classList.contains('displayHide')) {
        return btnOpen.classList.remove('displayHide');
    }
    return btnOpen.classList.add('displayHide');
}

const getSplitValue = (data, ...val) => {
    const split = data.value.split(" -- ");
    for (let i=0; i<val.length; i++) {
        const target = document.querySelector(`[data-cell*="${val[i]}"]`);
        target.textContent = split[i+1];
    }
}
