export function delChild(target) {
    const container = document.getElementById(target);
    if (container.childNodes.length > 0) {
        container.removeChild(container.lastChild);
        return;
    }
    alert('there is nothing to delete');
}