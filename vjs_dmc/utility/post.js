
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
