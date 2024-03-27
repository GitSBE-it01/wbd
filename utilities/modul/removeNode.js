export function rmvNode(...target) {
    target.forEach(tgt=> {
        if (document.getElementById(tgt)) {
            document.getElementById(tgt).remove();
        }
    })
    return;
}