export class buttonDOM {
    constructor(key) {
        this.key = key;
    }

    btn_hide (target) {
        const trgt = document.querySelector(target);
        trgt.classList.toggle('hidden');
        return;
    }
}
