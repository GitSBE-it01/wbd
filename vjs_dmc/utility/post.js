
const disabledBtn= (self, target) =>{
    const btntarget = document.querySelector(target);
    const btnSelf = document.querySelector(self);
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

const deleteChild = (target) => {
    const container = document.getElementById(target);
    container.remove();
}

const opnHide = (target) => {
    const cont = document.getElementById(target);
    if (cont.classList.contains('displayHide')) {
        cont.classList.remove('displayHide');
        return;
    }
    return cont.classList.add('displayHide');
}

const vjsDtInput = (target) => {
    const cont = document.getElementById(target);
    if (cont.classList.contains('displayHide')) {
        cont.classList.remove('displayHide');
        return;
    }
    return cont.classList.add('displayHide');
}

