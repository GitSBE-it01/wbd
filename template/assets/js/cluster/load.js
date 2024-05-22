import {createDiv,
} from "../index.js";

export const load = (target, loadClass) => {
    createDiv({
        selector: target,
        class: loadClass,
    })
}
