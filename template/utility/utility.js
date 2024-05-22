export const processSbmt = (element, target) =>{
    const input = document.querySelector(`#${element}`);
    input.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            const button = document.querySelector(`#${target}`);
            button.click()
        }
    })
}